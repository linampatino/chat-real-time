<template>
    <div>
        <h1>Board</h1>

        <div>
            <button  @mousedown='onHandlerCircleMouseDown' @mouseup='onHandlerCircleMouseUp'>Circle</button>
        </div>

        <div id="container" >
            <h1>container</h1>
        </div>

        <!--
        <v-stage :config="configKonva" >
            <v-layer>
                <v-circle :config="configCircle"></v-circle>
            </v-layer>
        </v-stage>
        -->
    </div>
</template>

    </div>
</template>

<script>
export default {
    data() {
        return {
            configKonva: {
                width: 200,
                height: 200, 
            },

            configCircle: {
                x: 100,
                y: 100,
                radius: 70,
                fill: "red",
                stroke: "black",
                strokeWidth: 4
            }, 

            initialPosition:{
                x:0,
                y:0,
            }, 

            FinalPosition:{
                x:0,
                y:0,
            }, 

            figure: null, 

            stage: null,
        };
    }, 

    mounted() {
        console.log('Component mounted. Board')
        this.createStage();

        Echo.private('chat-channel')
                .listen('BoardEvent', (e) => {
                    console.log('escuchando Board');
                    
                    var circle = new Konva.Circle(JSON.parse(e.figure));
                    this.addFigureToStage(circle);

                });
    }, 

    methods:{
        onHandlerCircleMouseDown(e) {
            //console.log('mousedown')
            ////console.log(e);

            this.initialPosition.x = e.screenX;
            this.initialPosition.y = e.screenY;
            ////console.log(this.initialPosition);
            this.figure = this.drawCircle();
            this.sendBoard();
        },

        onHandlerCircleMouseUp(e) {
            //console.log('mouseup');
            ////console.log(e);

            this.FinalPosition.x = e.screenX;
            this.FinalPosition.y = e.screenY;
            ////console.log(this.FinalPosition);
            this.drawCircle()
        },

        createStage(){
            var width = window.innerWidth;   //this.FinalPosition.x - this.initialPosition.x;
            var height = window.innerHeight; //this.FinalPosition.y - this.initialPosition.y;

            var stage = new Konva.Stage({
                container: 'container',
                width: width,
                height: height
            });

            this.stage = stage;
        },

        addFigureToStage(figure){
            var layer = new Konva.Layer();
            layer.add(figure);
            this.stage.add(layer);
        },

        drawCircle(){   
            var x = this.initialPosition.x ;
            var y = this.initialPosition.y ; 
            var radio = 100;//this.FinalPosition.x - x;

            var circle = new Konva.Circle(
                {
                    x: x,
                    y: y,
                    radius: radio,
                    fill: 'yellow',
                    stroke: 'black',
                    strokeWidth: 4
                }
            );
            this.addFigureToStage(circle);
            return circle;
        },

        sendBoard(){
            //console.log('sendBoard'); 
                if(this.figure !== null){
                    var json = this.figure.toJSON();

                    axios.post('/sendBoard', {
                        figure: json
                    })
                    .then(response => {
                        ////console.log(response);
                        //console.log('response');                        
                    })
                    .catch(error => {
                        //console.log(error);
                    });
                }            
            }

    }

};

</script>
