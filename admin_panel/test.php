<!DOCTYPE html>
<html>
<head>
    <title>Test Feedback AJAX</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h1>Testing Feedback AJAX</h1>
    <button id="testBtn">Test AJAX Call</button>
    <div id="result"></div>

    <script>
        document.getElementById('testBtn').addEventListener('click', function() {
            console.log('Making AJAX call...');
            
            $.ajax({
                url: 'ajax/feedback_action.php',
                type: 'POST',
                data: {
                    action: 'get_feedback'
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Success:', response);
                    document.getElementById('result').innerHTML = '<pre>' + JSON.stringify(response, null, 2) + '</pre>';
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.log('Response:', xhr.responseText);
                    document.getElementById('result').innerHTML = '<p style="color: red;">Error: ' + error + '</p><pre>' + xhr.responseText + '</pre>';
                }
            });
        });
    </script>
</body>
</html>