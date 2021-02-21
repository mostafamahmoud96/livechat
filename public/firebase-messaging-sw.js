/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');
   
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyCi__UdANWo7bDvTFCGOEtXvMIoDSxscZg",
    authDomain: "live-chat-4014a.firebaseapp.com",
    databaseURL: "https://live-chat-4014a-default-rtdb.firebaseio.com",
    projectId: "live-chat-4014a",
    storageBucket: "live-chat-4014a.appspot.com",
    messagingSenderId: "357072404378",
    appId: "1:357072404378:web:2f0b4b73e3d4b9a0ea4423",
    measurementId: "G-NG59Q52QD7"
    });
  
/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };
  
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});