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
    function drawImage(imageObj,posX,posY,widthImg,heightImg) {
        var img = new Konva.Image({
          image: imageObj,
          x: posX,
          y: posY,
          width: widthImg,
          height: heightImg,
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
      // mesas
      var imgMesa1 = new Image();
      var imgMesa2 = new Image();
      var imgMesa3 = new Image();
      var imgMesa4 = new Image();
      var imgMesa5 = new Image();
      var imgMesa6 = new Image();
      // meseros
      var imgMesero1 = new Image();
      var imgMesero2 = new Image();
      var imgMesero3 = new Image();
      // pista
      var imgPista = new Image();

      // banda src
      imgBanda.src = '/assets/img/banda.png';
      // mesas src
      imgMesa1.src='/assets/img/mesa.png';
      imgMesa2.src='/assets/img/mesa.png';
      imgMesa3.src='/assets/img/mesa.png';
      imgMesa4.src='/assets/img/mesa.png';
      imgMesa5.src='/assets/img/mesa.png';
      imgMesa6.src='/assets/img/mesa.png';
      // meseros src
      imgMesero1.src='/assets/img/mesero.png';
      imgMesero2.src='/assets/img/mesero.png';
      imgMesero3.src='/assets/img/mesero.png';
      // pista src
      imgPista.src = '/assets/img/pista3.png';
      // pintando banda
      drawImage(imgBanda,50,40,300,250);
      // pintando mesas
      drawImage(imgMesa1,460,1,150,137);
      drawImage(imgMesa2,700,1,150,137);
      drawImage(imgMesa3,460,160,150,137);
      drawImage(imgMesa4,700,160,150,137);
      drawImage(imgMesa5,460,330,150,137);
      drawImage(imgMesa6,700,330,150,137);
      // pintando meseros
      drawImage(imgMesero1,600,75,100,100);
      drawImage(imgMesero2,600,250,100,100);
      drawImage(imgMesero3,600,425,100,100);
      // pintando pista
      drawImage(imgPista,50,100,300,300);
     alert('2');
});