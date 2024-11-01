<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $educational = $_POST['educational'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $answers = [
        $_POST['question1'],
        $_POST['question2'],
        $_POST['question3']
    ];

    // Process the assessment results
    $score = array_count_values($answers)['yes'] ?? 0;

    // Send data to Python script
    $url = 'http://localhost:5000/process_data';
    $data = array('name' => $name, 'age' => $age, 'educational' => $educational, 'email' => $email, 'course' => $course, 'score' => $score );
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    // Display the result from Python
    echo "Response from Python: " . $result;

    $command = escapeshellcmd('sample machine.py');
    $output = shell_exec($command);

    // Display prediction result
    echo "<br>";
    echo "Prediction: " . $output;
}
?>
