<?php
    // Query the database, and returns the info
    $mysql_connection = null;
    $mysql_response = array();
    $mysql_status = "";

    mysqlConnect();
    $data = array();
    $status = "Fail : Action failed to match";

    function Done()
    {
        global $status;
        global $data;

        $response = array();
        $response['data'] = $data;
        $response['status'] = $status;

        echo json_encode($response);
        
        Die();
    }

    // GET Action for retrieving all the gameboard data in database
    function GetBoard()
    {
        global $mysql_connection;
        global $data;
        global $status;        
        $query = "SELECT * ";
        $query .= "FROM gameboard order by squareID";
        if( $results = mysqlQuery( $query ))
        {
            while ( $row = $results->fetch_assoc())
            {
               $temp = array();
               $temp['squareID']   = $row['squareID'];
               $temp['x']   = $row['x'];
               $temp['y']   = $row['y'];
               $temp['abbrev'] =  $row['abbrev'];
               $temp['color'] =  $row['color'];
               $temp['type'] =  $row['type'];
               $temp['moveTo'] =  $row['moveTo'];

               array_push($data, $temp);
            }
            $status = "{$results->num_rows} : Records found";
        }
        else
        {
            return "Query Error : $query";
        }
        return $data;
    } 

    
    // Call GetUsers if GET is set and action is GetUsers
    if ( isset($_GET["action"]) && $_GET["action"] == "GetGameboard" )
    {
        GetBoard();
    }


    function Insert($squareID, $x, $y, $abbrev,$color, $type)
    {
        global $status;

        // Doesnt exist? we can now add
        $query = "INSERT INTO gameboard (squareID, x, y, abbrev, color, 'type')";
        $query .= " VALUES($squareID, $x, $y, $abbrev, $color, $type)";
    
        return $numRows = mysqlNonQuery($query);
    }

    if (isset($_POST["action"]) && $_POST["action"] == "Insert") 
    {   
        $squareID = strip_tags($_POST["squareID"]);
        $x = strip_tags($_POST["x"]);
        $y = strip_tags($_POST["y"]);
        $abbrev = strip_tags($_POST["abbrev"]);
        $color = strip_tags($_POST["color"]);
        $type = strip_tags($_POST["type"]);
    
        $rowsaffected = Insert($squareID, $x,$y, $abbrev,$color, $type);
    }


    function EnableValidMoves($array)
    {
        global $status;
        $moveTo = "Yes";
        for($i = 0; $i < count($array); $i++)
        {
            $query = "UPDATE gameboard SET moveTo='$moveTo' WHERE squareID = '$array[$i]'";
            mysqlNonQuery($query);         
        }
    }
    if (isset($_POST["action"]) && $_POST["action"] == "EnableValidMoves") 
    {   
        $pos1 = strip_tags($_POST["pos1"]);
        $pos2 = strip_tags($_POST["pos2"]);
        $pos3 = strip_tags($_POST["pos3"]);
        $pos4 = strip_tags($_POST["pos4"]);
        $pos5 = strip_tags($_POST["pos5"]);
        $pos6 = strip_tags($_POST["pos6"]);
        $pos7 = strip_tags($_POST["pos7"]);
        $pos8 = strip_tags($_POST["pos8"]);
        $pos9 = strip_tags($_POST["pos9"]);
        $pos10 = strip_tags($_POST["pos10"]);
        $pos11 = strip_tags($_POST["pos11"]);
        $pos12 = strip_tags($_POST["pos12"]);
        $pos13 = strip_tags($_POST["pos13"]);
        $pos14 = strip_tags($_POST["pos14"]);
        $pos15 = strip_tags($_POST["pos15"]);
        $pos16 = strip_tags($_POST["pos16"]);
        $pos17 = strip_tags($_POST["pos17"]);
        $pos18 = strip_tags($_POST["pos18"]);
        $pos19 = strip_tags($_POST["pos19"]);
        $pos20 = strip_tags($_POST["pos20"]);
        $pos21 = strip_tags($_POST["pos21"]);
        $pos22 = strip_tags($_POST["pos22"]);
        $pos23 = strip_tags($_POST["pos23"]);
        $pos24 = strip_tags($_POST["pos24"]);
        $pos25 = strip_tags($_POST["pos25"]);


        $array = array($pos1, $pos2, $pos3, $pos4, $pos5, $pos6, $pos7, $pos8, $pos9, $pos10,
                       $pos11, $pos12, $pos13, $pos14, $pos15, $pos16, $pos17, $pos18, $pos19, $pos20, 
                       $pos21, $pos22, $pos23, $pos24, $pos25);
     
        $rowsaffected = EnableValidMoves($array); 
        $status = $rowsaffected." Rows Changed";
    }

    function DisableValidMoves($array)
    {
        global $status;
        $moveTo = "No";
        for($i = 0; $i < count($array); $i++)
        {
            $query = "UPDATE gameboard SET moveTo='$moveTo' WHERE squareID = '$array[$i]'";
            mysqlNonQuery($query);         
        }
    }
    if (isset($_POST["action"]) && $_POST["action"] == "DisableValidMoves") 
    {   
        $pos1 = strip_tags($_POST["pos1"]);
        $pos2 = strip_tags($_POST["pos2"]);
        $pos3 = strip_tags($_POST["pos3"]);
        $pos4 = strip_tags($_POST["pos4"]);
        $pos5 = strip_tags($_POST["pos5"]);
        $pos6 = strip_tags($_POST["pos6"]);
        $pos7 = strip_tags($_POST["pos7"]);
        $pos8 = strip_tags($_POST["pos8"]);
        $pos9 = strip_tags($_POST["pos9"]);
        $pos10 = strip_tags($_POST["pos10"]);
        $pos11 = strip_tags($_POST["pos11"]);
        $pos12 = strip_tags($_POST["pos12"]);
        $pos13 = strip_tags($_POST["pos13"]);
        $pos14 = strip_tags($_POST["pos14"]);
        $pos15 = strip_tags($_POST["pos15"]);
        $pos16 = strip_tags($_POST["pos16"]);
        $pos17 = strip_tags($_POST["pos17"]);
        $pos18 = strip_tags($_POST["pos18"]);
        $pos19 = strip_tags($_POST["pos19"]);
        $pos20 = strip_tags($_POST["pos20"]);
        $pos21 = strip_tags($_POST["pos21"]);
        $pos22 = strip_tags($_POST["pos22"]);
        $pos23 = strip_tags($_POST["pos23"]);
        $pos24 = strip_tags($_POST["pos24"]);
        $pos25 = strip_tags($_POST["pos25"]);

        $array = array($pos1, $pos2, $pos3, $pos4, $pos5, $pos6, $pos7, $pos8, $pos9, $pos10,
                       $pos11, $pos12, $pos13, $pos14, $pos15, $pos16, $pos17, $pos18, $pos19, $pos20, 
                       $pos21, $pos22, $pos23, $pos24, $pos25);
     
        $rowsaffected = DisableValidMoves($array); 
        $status = $rowsaffected." Rows Changed";
    }


    function DisableValidMoves2($squareID)
    {
        global $status;
        $moveTo = "No";
  
        $query = "UPDATE gameboard SET moveTo='$moveTo' WHERE squareID = '$squareID'";
        mysqlNonQuery($query);
        
             
    }
    if (isset($_POST["action"]) && $_POST["action"] == "DisableValidMoves2") 
    {   
        $array = $_POST["array"];
        for($i = 0; $i < count($array); $i++)
        {
            $rowsaffected += DisableValidMoves2($array[$i]["squareID"]); 
            $status = $rowsaffected;
        }

    }

    function Update($squareID, $abbrev, $color, $type, $moveTo)
    {
        global $status;

        $query = "UPDATE gameboard SET abbrev='$abbrev', color='$color', type='$type', moveTo='$moveTo' WHERE squareID = '$squareID'";
    
        return $numRows = mysqlNonQuery($query);
    }
    
    if (isset($_POST["action"]) && $_POST["action"] == "Update") 
    {   
        $squareID = strip_tags($_POST["squareID"]);
        $abbrev = strip_tags($_POST["abbrev"]);
        $color = strip_tags($_POST["color"]);
        $type = strip_tags($_POST["type"]);
        $moveTo = strip_tags($_POST["moveTo"]);



        $rowsaffected = Update($squareID, $abbrev, $color, $type, $moveTo);
        $status = "$rowsaffected rows have been changed";
    }   





    function mysqlConnect()
    {
        global $mysql_connection, $mysql_response;
        
        // local host, user, password, database name
        $mysql_connection = new mysqli("localhost", "kordyban_admin",
        "kanadaQ19!", "kordyban_chessboard"); 
        
        if($mysql_connection->connect_error)
        {
            $mysql_response[] = 'Connect Error (' . 
                    $mysql_connection->connect_errno .
                    ') ' . $mysql_connection->connect_error;
            
            echo json_encode($mysql_response);
            die();
        }
    } 

    function mysqlQuery( $query )
    {
        global $mysql_connection, $mysql_response, $mysql_status;
        
        $results = false;
        if($mysql_connection == null)
        {
            echo "No connection!";
            $mysql_status = "No active database connection.";
            return $results;
        }
        
        if(!($results = $mysql_connection->query( $query )))
        {
            $mysql_response[] = "Query Error {$mysql_connection->errno} : " .
                    "{mysql_connection->error}";
            
            echo json_encode($mysql_response);
            die();
        }    
        return $results;
    } 

    function mysqlNonQuery ( $query )
    {
        global $mysql_connection, $mysql_response;
        
        // I adjusted this part to just spit out an error and die so we know it happens 
        // at the database level.
        if ( $mysql_connection == null )
        {
            $mysql_response[] = "No active database connection!";
            echo json_encode($mysql_response);
            die();
        }
        
        // query will only return true or false when no result set is to be returned
        if (!($mysql_connection->query( $query )))
        {
            $mysql_response[] = "Query Error {$mysql_connection->errno} : " .
                                    "{$mysql_connection->error}";
            echo json_encode($mysql_response);
            die();
        }
        
        return $mysql_connection->affected_rows;
    }




     Done();
    // /https://thor.net.nait.ca/~kordyban/cmpe2500/ica03/webservice.php
    //  https://thor.net.nait.ca/~kordyban/cmpe2500/ica03/webservice.php?action=GetUsers

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hello!
    
</body>
</html>

<!-- 
CREATE TABLE IF NOT EXISTS `prj_users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(24) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `prj_users`
--

INSERT INTO `prj_users` (`userID`, `username`, `password`) VALUES
(2, 'willy', '$1$DCfCYnBa$3dMTo9n6nAc9hQyf0DydW1'),
(4, 'great', '$1$.XvPuDTW$O2TTNkU8lQVXIE5H4jARL1'); -->