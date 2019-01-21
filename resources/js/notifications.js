window.NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\UserFollowed',
    newPost: 'App\\Notifications\\NewPost'
};

window.allBox = 
`<li class="inbox-item inbox-se-link">
    <a class="d-block" href="#">
        see all inbox items
    </a>
</li>`;

window.noneBox = 
`<li class="inbox-item inbox-se-link">
    <a class="d-block" href="#">
        None of the box
    </a>
</li>`;

window.addNotifications = function (newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    notifications.reverse()
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    notifyLength = notifications.length;
    if(notifyLength) {
        notifications = notifications.slice(0, 5);
        var htmlElements = notifications.map(function (notification, key) {
            return makeNotification(notification);
        });
        $('#notifCount').html(getSpanCount(notifyLength));
        $(target).html(htmlElements.join('') + allBox);
        // $(target).addClass('has-notifications')
    } else {
        $(target).html(noneBox);
        $('#notifCount').html('');
    }
}

// Tạo ra chuỗi Notifi
window.makeNotification = function (notification) {
    return getHtml(notification);
}

// get the notification route based on it'sotifi
window.routeNotification = function (notification) {
    var to = '/post/' + notification.target_id;

    if(notification.type === NOTIFICATION_TYPES.follow) {
        to = '/user/' + notification.target_id;
    }

    return to + '?read=' + notification.id;
}

window.getSpanCount = function (count) {
    return `
        <span class="indicator-badge js-unread-count _important">
            ${count}
        </span>
    `;
}

window.getHtml = function (notification) {
    var to = routeNotification(notification);

    return `
    <li class="inbox-item unread-item">
        <a href="${to}" class="js-gps-track grid gs8 gsx">
            <div class="favicon favicon-stackoverflow site-icon grid--cell"></div>
            <div class="item-content grid--cell fl1">
                <div class="item-header">
                    <span class="item-type">${notification.titleI18n}</span>
                    <span class="item-creation">
                        <span class="relativetime">${notification.time_from_now}</span>
                    </span>
                </div>
                <div class="item-location">
                    ${notification.contentI18n}
                </div>
            </div>
        </a>
    </li>
    `;
}
