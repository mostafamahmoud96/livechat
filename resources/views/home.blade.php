@section('scripts')
    <script>
        // Retrieve Firebase Messaging object.
        const messaging = firebase.messaging();
        // Add the public key generated from the console here.
        messaging.usePublicVapidKey("AAAAUyMsf5o:APA91bESJLSyDnb50jKJ7V6NA9ojkboCb_Q31mQoS3FbjS2Maed4F0GfHSX9SGj-aN0SpG9rHJxKfW14XCCZIw1reyXfEM032KdZnx8ZNc5pBLZFq80WNG7qbQ_f8uK7ShSYy92PKQeI");


        function sendTokenToServer(fcm_token) {
            const user_id = '{{auth()->user()->id}}';
         
            axios.post('/api/save-token', {
                fcm_token, user_id
            })
                .then(res => {
                    console.log(res);
                })

        }

        function retreiveToken(){
            messaging.getToken().then((currentToken) => {
                if (currentToken) {
                    sendTokenToServer(currentToken);
                    // updateUIForPushEnabled(currentToken);
                } else {
                    // Show permission request.
                    //console.log('No Instance ID token available. Request permission to generate one.');
                    // Show permission UI.
                    //updateUIForPushPermissionRequired();
                    //etTokenSentToServer(false);
                    alert('You should allow notification!');
                }
            }).catch((err) => {
                console.log(err.message);
                // showToken('Error retrieving Instance ID token. ', err);
                // setTokenSentToServer(false);
            });
        }
        retreiveToken();
        messaging.onTokenRefresh(()=>{
            retreiveToken();


        });

        messaging.onMessage((payload)=>{
            console.log('Message received');
            console.log(payload);

            location.reload();
        });

    </script>
@endsection