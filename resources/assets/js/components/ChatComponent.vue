<template>
    <div class=" offset-4 col-4">
                    <li class="list-group-item active">Chat room</li>
                    
                        <!--  -->
                    <ul class="list-group" v-chat-scroll>
                        
                        <message-component 
                          v-for="value, index in chat.messages" 
                            :key="value.index"
                            :color=chat.colors[index]
                            :user=chat.users[index]
                        >
                            @{{ value }}
                        </message-component>
                        
                    </ul>
                        
                    <input  type="text" class="form-control" 
                            placeholder="Type your message here... "
                            v-model='message' 
                            @keyup.enter='send'>
                    
                </div>
    
</template>

<script>
    export default {
        data(){
            return{
                message: '',
                chat:{
                    messages: [],
                    users:[], 
                    colors: [],
                }
            }
            
        },

        mounted() {
            console.log('Component mounted chat....');

            Echo.private('chat-channel')
                .listen('ChatEvent', (e) => {
                    console.log('escuchando');
                    this.chat.messages.push(e.message);
                    this.chat.users.push(e.user);
                    this.chat.colors.push('warning');
                    console.log(e);
                });

        },

        methods:{
            send(){
                if(this.message.length != 0){
                    this.chat.messages.push(this.message);
                    this.chat.users.push({name:'You'});
                    this.chat.colors.push('success');
                    
                    axios.post('/send', {
                        message: this.message
                    })
                    .then(response => {
                        this.message = "";
                        console.log(response);
                        console.log('response');                        
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }            
            }
        },
    }
</script>
