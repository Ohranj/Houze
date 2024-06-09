import * as THREE from 'three';
import { FontLoader } from 'three/addons/loaders/FontLoader.js';
import { TextGeometry } from 'three/addons/geometries/TextGeometry.js'

class graphic {
	domain = {
		canvas: null,
		scene: null,
		camera: null,
		controls: null,
		topLight: null,
		ambientLight: null
	}
	config = {
		width: 150,
		height: 75,
		assets: [],
	}
	constructor(canvas) {
		this.domain.canvas = canvas;
	}
	initialise(setAxes) {
		this.domain.scene = new THREE.Scene();
		if (setAxes) {
			this.setAxesHelper()
		}
		this.createGeometry()
		this.setCamera()
		this.setTopLighting();
		this.setAmbientLight();
	}
	addToScene(asset) {
		this.domain.scene.add(asset);
	}
	setAxesHelper() {
		const axesHelper = new THREE.AxesHelper(2);
		this.addToScene(axesHelper)
	}
	createGeometry() {
		const textureLoader = new THREE.TextureLoader()
		const matcapTexture = textureLoader.load('/textures/matcap_5.png');
		matcapTexture.colorSpace = THREE.SRGBColorSpace;

		const fontLoader = new FontLoader();
		fontLoader.load('/fonts/Poppins_Bold.json', (font) => {
			const textGeometry = new TextGeometry(
				'Hello World. It\'s Alex',
				{
					font,
					size: 1,
					depth: 0.2,
					curveSegments: 2,
					bevelEnabled: true,
					bevelThickness: 0.03,
					bevelSize: 0.02,
					bevelOffset: 0,
					bevelSegments: 4
				}
			)
			textGeometry.center()
			const textMaterial = new THREE.MeshMatcapMaterial({ matcap: matcapTexture });
			const text = new THREE.Mesh(textGeometry, textMaterial)
			this.addToScene(text)
		})
	}
	setCamera() {
		const camera = new THREE.PerspectiveCamera(45, this.config.width / this.config.height, 0.1, 1000);
		camera.position.set(0, 0, 10);
		this.domain.camera = camera;
		this.addToScene(this.domain.camera);
	}
	setTopLighting() {
		const topLight = new THREE.DirectionalLight(0xffffff, 2.5);
        topLight.position.set(0, 1, 1)
        topLight.castShadow = true;
		this.domain.topLight = topLight
		this.addToScene(this.domain.topLight)
	}
	setAmbientLight() {
		const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
		this.domain.ambientLight = ambientLight;
		this.addToScene(this.domain.ambientLight);
	}
	render() {
		const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true });
		renderer.setSize(this.config.width, this.config.height);
		renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
		const tick = () => {
            renderer.render(this.domain.scene, this.domain.camera)
            window.requestAnimationFrame(tick)
        }
        tick()
	}
}

const canvas = document.getElementById('navCanvas')
const instance = new graphic(canvas);
instance.initialise(false);
instance.render()