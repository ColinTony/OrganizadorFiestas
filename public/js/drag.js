$(document).ready(function(){
	var width = window.innerWidth;
    var height = window.innerHeight;
    var layer = new Konva.Layer();

    var stage = new Konva.Stage({
    	container: 'container',
    	width: width,
    	height: height,
    });
    var text = new Konva.Text({
        x: 10,
        y: 10,
        fontFamily: 'Calibri',
        fontSize: 24,
        text: '',
        fill: 'black',
    });

    function writeMessage(message)
    {
        text.text(message);
        layer.draw();
    }
    /*
    	funcnion para dibuajar la imagen
    */
    function drawImage(imageObj,posX,posY) {
        var img = new Konva.Image({
          image: imageObj,
          x: posX,
          y: posY,
          width: 200,
          height: 137,
          draggable: true,
        });
        
        // add cursor styling
        img.on('mouseover', function () {
          document.body.style.cursor = 'move';
          writeMessage('x:'+img.absolutePosition().x+' '+'y:'+img.absolutePosition().y);
        });
        img.on('mouseout', function () {
          document.body.style.cursor = 'default';
          writeMessage('');
        });

        layer.add(img);
        stage.add(layer);
      }
      layer.add(text);
      // añadiendo componentes
      var imgBanda = new Image();
      var imgMesa1 = new Image();
      var imgMesa2 = new Image();
      var imgMesa3 = new Image();
      var imgMesa4 = new Image();
      var imgMesa5 = new Image();
      var imgMesa6 = new Image();
      imgMesa1.src='/assets/img/mesa.png';
      imgMesa2.src='/assets/img/mesa.png';
      imgMesa3.src='/assets/img/mesa.png';
      imgMesa4.src='/assets/img/mesa.png';
      imgMesa5.src='/assets/img/mesa.png';
      imgMesa6.src='/assets/img/mesa.png';
      imgBanda.src = '/assets/img/banda.png';
      
      drawImage(imgBanda,50,100);
      drawImage(imgMesa1,460,1);
      drawImage(imgMesa2,700,1);
      drawImage(imgMesa3,460,160);
      drawImage(imgMesa4,700,160);
      drawImage(imgMesa5,460,330);
      drawImage(imgMesa6,700,330);
     alert('2');
});