<?php
function connectToDb($sql)
{
    $server = "SERVER";
    $username = "username";
    $password = "password";
    $dbname = "dbname";
    $port = 3306;

    $conn = new mysqli($server, $username, $password, $dbname, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $array = [];
        while ($row = $result->fetch_assoc()) {
            array_push($array, $row);
            //echo "Name: " . $row["product_name"] . " , Amount: " . $row["amount_sold"] . "<br>";
        }
        $conn->close();
        return $array;
    } else {
        return false;
    }
    $conn->close();
}

function getDailyRapport()
{
    $total = 0;
    $swishTotal = 0;
    $kontantTotal = 0;
    $day = date("d");
    $month = date("m");
    $year = date("Y");

    $array = connectToDb("SELECT product_name, amount_sold, payment_method FROM Payment WHERE DAY(payment_date) = '$day' AND MONTH(payment_date) = '$month' AND YEAR(payment_date) = '$year'");
    if ($array != false) {
        foreach ($array as $row) {
            $amountSold = $row['amount_sold'];
            $prodName = $row['product_name'];
            $data = connectToDb("SELECT product_name, price FROM Products WHERE product_name = '$prodName'");
            foreach ($data as $product) {
                $total += ($product['price'] * $amountSold);
                switch ($row['payment_method']) {
                    case "Swish":
                        $swishTotal += ($product['price'] * $amountSold);
                        break;
                    case "Kontant":
                        $kontantTotal += ($product['price'] * $amountSold);
                        break;
                }
            }
        }
    }
    return "<div class='mb-4'><h2>Denna dag</h2></div>"
        . "<div class='mb-4'><h1>Summa: " . $total . " kr</h1>"
        . "<p>Swish: " . $swishTotal . " kr</p>"
        . "<p>Kontanter: " . $kontantTotal . " kr</p></div>";
}

function getMonthlyRapport()
{
    $total = 0;
    $swishTotal = 0;
    $kontantTotal = 0;
    $month = date("m");
    $year = date("Y");
    $array = connectToDb("SELECT product_name, amount_sold, payment_method FROM Payment WHERE MONTH(payment_date) = '$month' AND YEAR(payment_date) = '$year'");
    foreach ($array as $row) {
        $amountSold = $row['amount_sold'];
        $prodName = $row['product_name'];
        $data = connectToDb("SELECT product_name, price FROM Products WHERE product_name = '$prodName'");
        foreach ($data as $product) {
            $total += ($product['price'] * $amountSold);
            switch ($row['payment_method']) {
                case "Swish":
                    $swishTotal += ($product['price'] * $amountSold);
                    break;
                case "Kontant":
                    $kontantTotal += ($product['price'] * $amountSold);
                    break;
            }
        }
    }
    echo "<div class='mb-4'><h2>Denna månad</h2></div>"
        . "<div class='mb-4'><h1>Summa: " . $total . " kr</h1>"
        . "<p>Swish: " . $swishTotal . " kr</p>"
        . "<p>Kontanter: " . $kontantTotal . " kr</p></div>";
}
