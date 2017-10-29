<?php
	class News
	{
		private $connection;
		private $id;
		private $title;
		private $slug;
		private $pdf;
		private $image;
		private $content;
		private $news_date;
		
		public function __construct($data,$connection)
		{
			$this->connection=$connection;
			if(is_array($data))//INSERT
			{
				$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$sql="INSERT INTO news SET ";
				$count=count($data);
				$i=1;
				foreach($data as $key=>$value)
				{
					$sql.="$key=:$key";
					if($i<$count)
					{
						$sql.=",";	
					}
					$i++;
				}
				$query=$connection->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
				
				foreach($data as $key=>$value)
				{
					$query->bindValue(":$key",$value,PDO::PARAM_STR);
				}
				
				try
				{
					$query->execute();
					$this->id=$connection->lastInsertId();
				}
				catch(PDOException $e)
				{
					die($e->getMessage());
				}
				$this->id=$connection->lastInsertId();
				
				if($this->id>0)
				{
					$this->title=$data['title'];
					
					$this->slug=$data['title']."-".$data['id'];
					$this->slug=create_slug($this->slug);
					
					$this->content=$data['content'];
					$this->news_date=$data['news_date'];	
					
					$this->image=$data['image'];
					$this->pdf=$data['pdf'];
				}
			}
			else 
			{
				if(!stristr($data,'-')===FALSE)//i.e. SLUG=this-is-a-new-news-item-2
				{
					$data=explode("-",$data);
					$data=$data[count($data)-1];
					$this->id=$data;
				}
				else if(intval($data)>0)
				{
					$this->id=$data;					
				}
				$sql="SELECT * FROM news WHERE id='$this->id'";
									
				$query=$connection->query($sql);
				$data=$query->fetch(PDO::FETCH_ASSOC);
				
				$this->title=$data['title'];
				
				$this->slug=$data['title']."-".$data['id'];
				$this->slug=create_slug($this->slug);
				
				$this->content=$data['content'];
				$this->news_date=$data['news_date'];	
				
				$this->image=$data['image'];
				$this->pdf=$data['pdf'];
			}
		}
	
		public function __get($attr)
		{
			return $this->$attr;
		}

		public function __set($attr, $val)
		{
			$this->$attr=$val;
		}
		
		public static function get_all_news_items($connection,$limit="")
		{
			$sql="
				SELECT *
				FROM news
				ORDER BY news_date DESC 
			";
			if($limit!="")
			{
				$sql.="
					LIMIT $limit
				";
			}
			$query=$connection->query($sql);
			$row=$query->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		}
	}
?>