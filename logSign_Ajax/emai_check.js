function isEmailExists($db, $tableName, $email)
{
        // SQL Statement
        $sql = "SELECT * FROM ".$tableName." WHERE email='".$email."'";

        // Process the query
        $results = $db->query($sql);

        // Fetch Associative array
        $row = $results->fetch_assoc();

        // Check if there is a result and response to  1 if email is existing
        return (is_array($row) && count($row)>0);
}