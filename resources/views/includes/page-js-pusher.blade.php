<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/js/app.min.js"></script>
<script src="/assets/js/theme/transparent.min.js"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
</script>
<!-- ================== END BASE JS ================== -->
  <!-- Incldue Pusher Js Client via CDN -->
    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
    <!-- Alert whenever a new notification is pusher to our Pusher Channel -->

    <script>
    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notifications          = notificationsWrapper.find('ul.notifications');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));

    if (notificationsCount <= 0) {
        notificationsWrapper.hide();
      }

    //Remember to replace key and cluster with your credentials.
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'us2',
        encrypted: true
    });

        //Also remember to change channel and event name if your's are different.
        var channel = pusher.subscribe('repairComplete');
        channel.bind('repair-complete', function(message) {
            var existingNotifications = notifications.html();
            var newNotificationHtml = `
        <a href="javascript:;" class="dropdown-item media">
					<div class="media-left">
						<i class="fa fa-bug media-object bg-silver-darker"></i>
					</div>
					<div class="media-body">
						<h6 class="media-heading text-wrap">`+ message + `<i class="fa fa-exclamation-circle text-danger"></i></h6>
						<div class="text-muted f-s-10">3 minutes ago</div>
					</div>
				</a>
        `;

            notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
        });

    </script>
@stack('scripts')
