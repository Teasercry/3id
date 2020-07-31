<script>
        window.watsonAssistantChatOptions = {
            integrationID: "228f4f90-408f-4135-aa75-a317f887f613", // The ID of this integration.
            region: "us-south", // The region your integration is hosted in.
            serviceInstanceID: "f26120d4-75c0-403c-9d8b-0c0727d4f75a", // The ID of your service instance.
            onLoad: function(instance) {
                instance.render();
            }
        };
        setTimeout(function() {
            const t = document.createElement('script');
            t.src = "https://web-chat.global.assistant.watson.appdomain.cloud/loadWatsonAssistantChat.js";
            document.head.appendChild(t);
        });
    </script>