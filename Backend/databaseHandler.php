<?php
    // Include credentials for the entire database.
    include "../Backend/credentials.php";
    include "../Backend/console.php"; 

    class DatabaseHandler {
        // create a secure database connection
        public static function dbconnect(){
            global $server, $username, $password, $dbname, $port;

            try{
                $connection = mysqli_connect($server, $username, $password, $dbname, $port);

                if(!$connection){
                    console("Connection failed: " . mysqli_connect_error()); 
                    die;
                }

                return $connection;
            } catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $connection;
        }

        // fetch data securely and prevent SQL injection
        public static function fetchData($sqlquery, $connection){
            try {
                $stmt = $connection->prepare($sqlquery);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                console("Fetching data success!");
                return $result;
            } catch (\Throwable $th) {
                console($th->getMessage());
                console($th->getLine());
            }
        }

        public static function getAvailableProducts(){
            $connection = DatabaseHandler::dbconnect();
            $sqlGetProduct  = 'SELECT * FROM Products';
            $products       = DatabaseHandler::fetchData($sqlGetProduct, $connection);
            $connection->close();
            return $products;
        }
    }
?>
