var scene, renderer, camera;
var canvas = document.getElementById('backcanvas');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
/*var ctx=canvas.getContext("2d");
ctx.fillRect(0,0,canvas.width,canvas.height);*/

//渲染器
renderer=new THREE.WebGLRenderer({
	canvas:canvas,
	alpha:true
});
renderer.setClearColor(0x000000,1);

//场景
scene = new THREE.Scene();

//添加相机
camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 2, 10);
//camera.position.set(-2, 4, 8);
scene.add(camera);
//添加模型
var loader = new THREE.TextureLoader();
var image = loader.load('../sourse/images/earth.jpg');
var geo = new THREE.SphereGeometry(4, 32, 32);
var MeshPhongMaterial = new THREE.MeshPhongMaterial({map:image});
var earth = new THREE.Mesh(geo, MeshPhongMaterial);
scene.add(earth);
//添加光源
var spotLight = new THREE.SpotLight( 0xffffff );
spotLight.position.set( 40, 20, 10 );
scene.add( spotLight );

///////////////////////////////
for ( var i = 0; i < 30; i++ ) {
        var deepColor=Math.round(Math.random()*255);
        var lightColor=Math.round(deepColor*32/255);
		var colors = [
            {start:0,rgba:'rgba(255,255,255,1)'},
            {start:0.2,rgba:'rgba(0,'+deepColor+','+Math.round(Math.random()*80+175)+',1)'},
            {start:0.4,rgba:'rgba(0,'+lightColor+',64,1)'},
            {start:1,rgba:'rgba(0,0,0,1)'}
        ];
		var coord = new THREE.Vector3(Math.random()*10,Math.random()*10,Math.random()*10);
		var map = createCanvas(32,32,colors);
		var material = new THREE.SpriteMaterial( { map: new THREE.CanvasTexture(map), blending: THREE.AdditiveBlending,color: 0xffffff, fog: true ,overdraw:true,
                    depthWrite:false} );
		var sprite = new THREE.Sprite( material );
        sprite.scale.x = sprite.scale.y = Math.random()*2;
		sprite.position.set(coord.x,coord.y,coord.z);
		scene.add( sprite );
}

////////////////////////////
function createCanvas(width,height,colors){//创建画布并绘制精灵纹理
    var dot = document.createElement('canvas');
    dot.width = width;
    dot.height = height;
    var context = dot.getContext('2d');
    var gradient = context.createRadialGradient( dot.width / 2, dot.height / 2, 0, dot.width / 2, dot.height / 2, dot.width / 2 );
    colors.forEach(function(color){
        gradient.addColorStop( color.start, color.rgba );
    })
    context.fillStyle = gradient;
    context.fillRect(2, 2, 30, 30);
    return dot;
}


setTimeout(function(){
	camera.position.set(2.2,1.5,8);
	renderer.render(scene,camera);
	render();
},1000);

function render() {
	requestAnimationFrame(render);
	earth.rotation.y += 0.001;
	renderer.render(scene, camera);
};

