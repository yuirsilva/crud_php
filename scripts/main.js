document.documentElement.classList.toggle('menu-active')

if (history.scrollRestoration) { history.scrollRestoration = 'manual' }
else
{
    window.onbeforeunload = function() {
        window.scrollTo(0, 0)
    }
}

import * as THREE from 'three'
import { GLTFLoader } from 'https://unpkg.com/three@0.145.0/examples/jsm/loaders/GLTFLoader.js'
import { DRACOLoader } from 'https://unpkg.com/three@0.145.0/examples/jsm/loaders/DRACOLoader.js'

export default class Sketch
{
    constructor(options) {
        this.container = options.domElement

        this.sizes = { width: this.container.offsetWidth, height: this.container.offsetHeight }

        this.scene = new THREE.Scene()

        this.camera = new THREE.PerspectiveCamera(40, this.sizes.width / this.sizes.height, 0.01, 10)
        this.camera.position.z = 3
        this.scene.add(this.camera)

        this.renderer = new THREE.WebGLRenderer({
            antialias: true,
            alpha: true
        })
        this.renderer.outputEncoding = THREE.sRGBEncoding

        this.container.appendChild(this.renderer.domElement)

        this.time = Date.now()
        this.mouse = new THREE.Vector2()

        // Loaders
        this.gltfLoader = new GLTFLoader()
        this.dracoLoader = new DRACOLoader()

        this.dracoLoader.setDecoderPath('https://raw.githubusercontent.com/mrdoob/three.js/dev/examples/js/libs/draco/')
        this.gltfLoader.setDRACOLoader(this.dracoLoader)

        this.resize()
        this.addObjects()
        this.render()
        this.setupMouse()
        this.setupResize()
        this.animations()
        this.animationSteps()
    }

    resize() {
        this.sizes.width = this.container.offsetWidth
        this.sizes.height = this.container.offsetHeight
        
        this.renderer.setSize(this.sizes.width, this.sizes.height)
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
        
        this.camera.aspect = this.sizes.width / this.sizes.height
        this.camera.updateProjectionMatrix()
    }
    
    setupResize() {
        window.addEventListener('resize', this.resize.bind(this))
    }

    addObjects() {
        this.center = new THREE.Vector3()
        this.obj = null

        this.gltfLoader.load('./scripts/obj.glb', (glb) => {
            this.obj = glb.scene
            this.obj.traverse((child) => {
                if (child.isMesh === true) {
                    child.material.envMap = new THREE.CubeTextureLoader()
                    .setPath('./scripts/cubemap/')
                    .load(['px.png', 'nx.png', 'py.png', 'ny.png', 'pz.png', 'nz.png'])
                    child.material.roughness = 0.12
                    child.material.metalness = 0.15
                    child.geometry.computeBoundingBox()
                    child.geometry.boundingBox.getCenter(this.center)
                    child.geometry.center()
                    child.position.copy(this.center)
                }
                if (child.name == 'Plane001') {
                    child.children[0].material.color.set(0x080808)
                }
            })

            this.obj.scale.set(0.15, 0.15, 0.15)
            this.obj.position.y = -0.2
            this.obj.rotation.y = Math.PI * -0.5

            this.scene.add(this.obj)
        })
    }

    mausee(mm) {
        this.mouse.x = mm.clientX / this.sizes.width * 2 - 1
        this.mouse.y = - (mm.clientY / this.sizes.height) * 2 + 1
    }

    setupMouse() {
        window.addEventListener('mousemove', (mm) => this.mausee(mm))
    }

    animations() {
        this.faqItem = document.querySelectorAll('.faq-item')
        this.faqItem.forEach(item => { item.onclick = () => { item.classList.toggle('opened') } })

        function reverseComplete() { document.documentElement.classList.toggle('menu-active') }
        
        this.loadingTl = gsap.timeline({onReverseComplete: reverseComplete })
        this.mediaQuery = window.matchMedia('( max-width: 520px )')

        if(this.mediaQuery.matches) {
            this.loadingTl.to('.intro-wrapper div:not(:first-child) h1', { clipPath: 'inset(0%)', duration: 0.2 })
            .to('.intro-wrapper div:nth-child(2)', { top: '45%', duration: 0.6 }, '<')
            .to('.intro-wrapper div:nth-child(3)', { top: '55%', duration: 0.6 }, '<')

            this.animationSteps()
        } else {
            this.loadingTl.to('.intro-wrapper div:not(:first-child) h1', { clipPath: 'inset(0%)', duration: 0.2 })
            .to('.intro-wrapper img', { clipPath: 'inset(32% 15% 32% 15%)', duration: 0.6 })
            .to('.intro-wrapper div:nth-child(2)', { top: '40%', duration: 0.6 }, '<')
            .to('.intro-wrapper div:nth-child(3)', { top: '60%', duration: 0.6 }, '<')

            this.animationSteps()
        }
    }

    animationSteps() {
        this.loadingTl.to('.intro-wrapper-logo h1', { y: 0, rotate: 0, duration: 0.8 }, '<')
        .add(() => { this.loadingTl.reverse() }, '+=1')
        gsap.to('.intro-wrapper img', { clipPath: 'inset(50% 0% 50% 0%)', delay: 4 })
        gsap.to('.intro-wrapper', { bottom: '100%', delay: 4.8 })
    }

    render() {
        this.currentTime = Date.now()
        this.deltaTime = this.currentTime - this.time
        this.time = this.currentTime

        if(this.obj) {
            this.obj.rotation.y = lerp(this.obj.rotation.y, this.mouse.x * 0.5 - Math.PI * 0.5, 0.07)
            this.obj.rotation.z = lerp(this.obj.rotation.z, this.mouse.y * 0.5 - Math.PI * 2, 0.07)
        }

        this.renderer.render(this.scene, this.camera)

        requestAnimationFrame(this.render.bind(this))
    }
}

new Sketch({
    domElement: document.getElementById('container')
})