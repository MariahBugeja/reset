
function fetchNotificationCount() {
    return Math.floor(Math.random() * 10); 
}

function updateNotificationCount() {
    var notificationCountElement = document.getElementById('notificationCount');
    var notificationCount = fetchNotificationCount(); 
    notificationCountElement.textContent = notificationCount; 
}

updateNotificationCount();
setInterval(updateNotificationCount, 5000);
