Vue.component('my-notification', {
    template: '#notificationAreaTemplate',
    components: {

    },
    data: function () {
        return {
            myNotifications: {
                data: {
                    read: [],
                    unread: [],
                    total_unread: 0
                }
            },
            is_show: false,
        }
    },

    mounted() {
        this.getMyNotificationData();
    },

    created () {
        window.addEventListener('click', this.hiddenNotificationCounter)
    },

    methods: {
        async getMyNotificationData() {
            let vm = this;
            let myNotifications = await $.get('/notifications/me');
            vm.$nextTick(() => {
                vm.myNotifications = myNotifications;
                vm.is_show = true;
            });

            myNotifications.data.unread.forEach(notification => {
                notification.is_show_action = 0;
            });

            myNotifications.data.read.forEach(notification => {
                notification.is_show_action = 0;
            });
        },

        markAllNotificationsAsRead() {
            this.myNotifications.data.unread.forEach(notificationItem => {
                notificationItem.read_at = Date.now();
            });
            $.post('/notifications/mark-read-all').then(response => {
                console.log(response)
            });
        },

        stopCloseDropdown() {
            
        },

        hiddenNotificationCounter(e) {
            this.is_show = false;
        },

        markNotificationAsRead(notification) {
            console.log(notification)
        },

        showAction(notification) {
            notification.is_show_action = true;
        },

        closeOtherAction(notification) {
            this.myNotifications.data.unread.forEach(notificationItem => {
                if (notification.id != notificationItem.id) {
                    notificationItem.is_show_action = false;
                }
            });

            this.myNotifications.data.read.forEach(notificationItem => {
                if (notification.id != notificationItem.id) {
                    notificationItem.is_show_action = false;
                }
            });
        },

        deleteNotification(notification) {
            let notificationPosition = this.myNotifications.data.read.indexOf(notification);
            if (notificationPosition > -1)  {
                return this.myNotifications.data.read.splice(notificationPosition, 1);
            }else {
                notificationPosition = this.myNotifications.data.unread.indexOf(notification);
                return this.myNotifications.data.unread.splice(notificationPosition, 1);
            }
        }
    },
});

Vue.component('notification-item', {
    template: '#notificationItemTemplate',
    props: ['notification'],
    methods: {
        async markAsRead(notification) {
            let notificationItem = await $.post('/notifications/mark-read', {
                id: notification.id
            });

            if (notificationItem.success) {
                notification.read_at = Date.now();
            }
        },

        
        toggleShowAction(notification) {
            notification.is_show_action = !notification.is_show_action;
            this.$emit('closeOtherAction', notification)
        },

        async markAsUnread(notification) {
            let notificationItem = await $.post('/notifications/mark-unread', {
                id: notification.id
            });

            if (notificationItem.success) {
                notification.read_at = null;
            }
        },

        async deleteNotification(notification) {
            Swal.fire({
                title: `Action can not be undo!`,
                text: `Delete this notification?`,
                icon: 'warning',
                showCancelButton: true,
            }).then(choice => this.excecuteDeleteNotification(choice, notification))
        },

        async excecuteDeleteNotification(choice, notification) {
            if (choice.isConfirmed) {
                let deleteNotificationResult = await $.post('/notifications/' + notification.id, {
                    _method: 'DELETE'
                });
                
                if (deleteNotificationResult.success) {
                    this.$emit('deleteNotification', notification);
                }
            }
        }
    }
});

new Vue({ 
    el: '#app-notification',
    delimiters: ['[[', ']]'],
});