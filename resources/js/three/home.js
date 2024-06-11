import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

class Graphic {
	domain = {
		scene: null,
		canvas: {
			instance: null,
			container: null
		},
		camera: null
	}
	constructor(canvas, canvasContainer) {
		this.domain.canvas.instance = canvas;
		this.domain.canvas.container = canvasContainer;
	}
	init() {
		this.domain.scene  = new THREE.Scene();
		this.setCamera()
		this.loadModel()
		this.setTopLight()
		this.setAmbientLight()
	}
	setCamera() {
		const {canvas, scene} = this.domain;
		const camera = new THREE.PerspectiveCamera(45, canvas.container.offsetWidth / canvas.container.offsetHeight, 0.1, 1000);
		camera.position.set(0, 0, 1000);
		this.domain.camera = camera;
		scene.add(this.domain.camera);
	}
	loadModel() {
        const loader = new GLTFLoader();
        const that = this;
    
        loader.load('/storage/house.glb', (gltf) => {
            const item = gltf.scene;
            item.position.set(0, -350, 0)
			item.rotation.y = 1500;
            item.scale.set(0.5, 0.5, 0.5);
            that.domain.scene.add(item);
        }, null, (e) => {
            console.log('Error loading model', e)
        })
    }
	setTopLight() {
        const topLight = new THREE.DirectionalLight(0xffffff, 2.5);
        topLight.position.set(0, 1.5, 5.5)
        topLight.castShadow = true;
        this.domain.scene.add(topLight);
    }
    setAmbientLight() {
        const ambientLight = new THREE.AmbientLight(0xffffff, 1);
        this.domain.scene.add(ambientLight)
    }
	render() {
		const { canvas, scene, camera } = this.domain;
		const rendered = new THREE.WebGLRenderer({ canvas: canvas.instance, alpha: true, antialias: true });
        rendered.setSize(canvas.container.offsetWidth, canvas.container.offsetHeight);
        rendered.setPixelRatio(Math.min(window.devicePixelRatio, 2))

        const tick = () => {
        	rendered.render(scene, camera)
        	window.requestAnimationFrame(tick)
        }
        tick()
	}
}

const canvas = document.getElementById('h_logo_graphic');
const canvasContainer = document.getElementById('c_h_container')
const graphic = new Graphic(canvas, canvasContainer);
graphic.init();
graphic.render();