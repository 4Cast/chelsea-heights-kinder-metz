<?php
	class SQL
	{
		public static function get_page_content_details($connection)
		{
			$sql="
				SELECT *
				FROM page_descriptions
			";
			$query=$connection->query($sql);
			$row=$query->fetchAll(PDO::FETCH_ASSOC);
			return $row;
			
		}
		
		public static function get_page_tiles($connection,$type)
		{
			$sql="
				SELECT *
				FROM image_tiles
				WHERE type='$type'
			";
			$query=$connection->query($sql);
			$rows=$query->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		}
		
		public static function get_page_content($page_name,$connection)
		{
			$sql="
				SELECT content
				FROM page_descriptions
				WHERE page_name=\"$page_name\"
			";
			$query=$connection->query($sql);
			$row=$query->fetch(PDO::FETCH_ASSOC);
			return $row['content'];
		}
		
		public static function update_sql($table_name,$details_array,$id,$connection)
		{
			$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql="UPDATE $table_name SET ";
			$count=count($details_array);
			$i=1;
			foreach($details_array as $key=>$value)
			{
				$sql.="$key=:$key";
				//$sql.="$key='$value'";
				if($i<$count)
				{
					$sql.=",";	
				}
				$i++;
			}
			$sql=$sql." WHERE id='$id'";
			$query=$connection->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
			
			foreach($details_array as $key=>$value)
			{
				$query->bindValue(":$key",$value,PDO::PARAM_STR);
			}
			
			try
			{
				$query->execute();
				return true;
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
				return false;
			}
		}
		
		public static function insert_sql($table_name,$data_array,$connection)
		{
			$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql="INSERT INTO $table_name SET ";
			$count=count($data_array);
			$i=1;
			foreach($data_array as $key=>$value)
			{
				$sql.="$key=:$key";
				if($i<$count)
				{
					$sql.=",";	
				}
				$i++;
			}
			$query=$connection->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
			
			foreach($data_array as $key=>$value)
			{
				$query->bindValue(":$key",$value,PDO::PARAM_STR);
			}
			
			try
			{
				$query->execute();
				return $connection->lastInsertId();
			}
			catch(PDOException $e)
			{
				return false;
				die($e->getMessage());
			}	
		}
	}
?>