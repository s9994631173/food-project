function draw(obj){
    let r = obj.r
    let radians = obj.radians
    let bgColor = obj.bgColor
    let color = obj.color
    
    var canvas = document.getElementById('cnvs');
    var ctx = canvas.getContext('2d');

    ctx.lineWidth = 20;
    
    // background
    ctx.beginPath();
    ctx.arc(150, 150, r, getRadians(-90), getRadians(360));
    ctx.strokeStyle = bgColor
    ctx.stroke();
    ctx.closePath();
    
    // line
    ctx.beginPath();
    ctx.arc(150, 150, r, getRadians(-90), radians);
    ctx.strokeStyle = color
    ctx.stroke();
    ctx.closePath();
    
    // start
    ctx.beginPath()
    ctx.arc(150, 150-r, 10,getRadians(-90), getRadians(360));
    ctx.fillStyle = color
    ctx.fill()
    
    // finall
    let coordinates = getCoordinates({
        radians: radians,
        r: r
    })

    ctx.beginPath()
    ctx.arc(coordinates.x,coordinates.y,10,getRadians(-90), getRadians(360));
    ctx.fillStyle = color
    ctx.fill()
}

function getRadians(degrees) {
    return (Math.PI / 180) * degrees;
}

function getDegres(num){
    return (-90 + (num * 3.6))
}

function getCoordinates(obj){
    return {
        x: 150 + (obj.r * Math.cos(obj.radians)),
        y: 150 + (obj.r * Math.sin(obj.radians)),
    }
}

