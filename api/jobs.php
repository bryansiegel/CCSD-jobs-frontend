<?php

// Define the API endpoint
$api_url = 'http://localhost:8080/api/v1/jobs';

// Initialize cURL
$curl = curl_init();

// Set cURL options
curl_setopt($curl, CURLOPT_URL, $api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPGET, true);

// Add authentication header (Basic Auth)
$username = 'staging_kx7bw2';
$password = 'q8pNzMKdVEcH';
curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");

// Execute the request and store the response
$response = curl_exec($curl);

// Check if the request was successful
if ($response === false) {
    echo 'cURL Error: ' . curl_error($curl);
} else {
    // Decode the JSON response into a PHP array
    $jobs = json_decode($response, true);

    // Check if decoding was successful
    if (json_last_error() === JSON_ERROR_NONE) {
        // Process the posts

        // var_dump($posts); ?>
<table class="table table-striped" style="width:100%" id="jobsTable">
<thead>
    <th>Job Title</th>
    <th>Job Category</th>
    <th></th>
</thead>
<tbody>

<?php foreach ($jobs as $job) { ?>

    <tr>
        <td><?php echo $job['jobTitle']; ?></td>
        <td><?php

        if($job['jobCategory'] == 'support') {
            echo 'Support Professional';
        } else if($job['jobCategory'] == 'admin') {
            echo 'Administrative Personnel';
        } else if($job['jobCategory'] == 'licensed') {
            echo 'Licensed Personnel';
        } else {
            echo $job['jobCategory'];
        }
          
         
         ?></td>
        <td>
            <a href="http://localhost:8080/job/details/<?php echo $job['id']; ?>" target="_blank" style="background-color: #31d2f2; padding-top:10px;padding-bottom: 10px; padding-left:15px; padding-right:15px; color:black;text-decoration:none;font-weight:bold;margin-right: 10px;"><i class="fa-solid fa-circle-arrow-right"></i> View</a>
            <a href="<?php echo $job['applyLink'];?>" style="background-color: #bb2d3b; padding-top:10px;padding-bottom: 10px; padding-left:15px; padding-right:15px; color:white;text-decoration:none;font-weight:bold;margin-left: 10px;" target="_blank"><i class="fa-solid fa-file-import"></i> Apply</a>
        </td>
    </tr>
    <?php } ?>
</tbody>

</table>
<hr>


           <?php //echo '<strong>Job Title:</strong> ' . $job['jobTitle'] . '<br>'; ?>
         
        
   <?php } else {
        echo 'JSON Decode Error: ' . json_last_error_msg();
    }

    // Close the cURL session
    curl_close($curl);
}

?>
