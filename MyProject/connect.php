<?php 
$Name = $_POST['name']
$PhoneNumber = $_POST['phonenumber']
$Date = $_POST['date']
$Time = $_POST['time']
$Address = $_POST['address']

if(!empty($Name),!empty($PhoneNumber),!empty($Date),!empty($Time),!empty($Address)){
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "kabadiwala";
        // create a connection
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }else{
            else {
                $Select = "SELECT PhoneNumber FROM register WHERE PhonrNumber = ? LIMIT 1";
                $Insert = "INSERT INTO register(username, password, Name, PhoneNumber, Date, Time Address) values(?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($Select);
                $stmt->bind_param("s", $PhoneNumber);
                $stmt->execute();
                $stmt->bind_result($resultPhonrNumber);
                $stmt->store_result();
                $stmt->fetch();
                $rnum = $stmt->num_rows;
                if ($rnum == 0) {
                    $stmt->close();
                    $stmt = $conn->prepare($Insert);
                    $stmt->bind_param("ssssii",$Name, $PhoneNumber, $Date, $Time, $Address);
                    if ($stmt->execute()) {
                        echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
        

?>