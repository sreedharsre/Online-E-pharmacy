 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Change Password</h2>
    <form id="changePasswordForm">
        <label for="currentPassword">Current Password:</label>
        <input type="password" id="currentPassword" name="currentPassword" required>
        
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>
        
        <label for="confirmNewPassword">Confirm New Password:</label>
        <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
        
        <button type="submit">Change Password</button>
    </form>
    
     
</body>
</html>