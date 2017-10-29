<?php
	class Staff
	{
		private $connection;
		private $id;
		private $name;
		private $row;
		private $slug;
		private $image;
		private $introduction;
		private $title;
		private $qualifications;
		private $created;
		
		public function __construct($data,$connection)
		{
			$this->connection=$connection;
			if(is_array($data))//INSERT
			{
				$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$sql="INSERT INTO staff SET ";
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
					$this->name=$data['name'];
					$this->slug=create_slug($data['name']);
					$this->image=$data['image'];
					$this->row=$data['row'];
					$this->introduction=$data['introduction'];
					$this->description=$data['description'];
					$this->created=$data['created'];		
					$this->title=$data['title'];	
					$this->qualifications=$data['qualifications'];
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
				$sql="SELECT * FROM staff WHERE id='$this->id'";
									
				$query=$connection->query($sql);
				$row=$query->fetch(PDO::FETCH_ASSOC);
				
				$this->name=$row['name'];
				$this->slug=$row['slug'];
				$this->image=$row['image'];		
				$this->row=$row['row'];		
				$this->introduction=$row['introduction'];
				$this->description=$row['description'];
				$this->created=$row['created'];		
				$this->title=$row['title'];	
				$this->qualifications=$row['qualifications'];
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
	
		public static function get_staff($connection,$row_number="")
		{
			$sql="
				SELECT *
				FROM staff
			";
			if($row_number!="")
			{
				$sql.="
					WHERE row='$row_number'
				";
			}
			$query=$connection->query($sql);
			$rows=$query->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		}
	}
?>