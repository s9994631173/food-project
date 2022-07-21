function drawLine(array){
    var canvas=document.getElementById('cnvsLine');
    var ctx = canvas.getContext('2d');
    
    var gradient = ctx.createLinearGradient(10, 0, 100, 0);

    gradient.addColorStop(0, "#7cef14");
    gradient.addColorStop(1, "#b3f322");
    
    ctx.lineWidth = 5;
    
    ctx.beginPath() 
    ctx.moveTo(300,130)
    let x = 260
    for(var i=0; i<array.length; i++){
        ctx.lineTo(x, array[i][2]+10)
        x -= 37
    }
    ctx.strokeStyle = gradient
    ctx.stroke()
    
}