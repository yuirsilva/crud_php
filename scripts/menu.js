const nav = document.querySelector('.nav')
const closeNav = document.querySelector('.close')
const menu = document.querySelector('.menu-m')
const tl = gsap.timeline()
nav.onclick = () =>
{
    tl.to(nav, { clipPath: 'circle(0px at center)' })
    .add(menuFunc, "<0.4")
    .to('.menu-m', { display: 'flex',  yPercent: 100, ease: 'Power3.easeInOut', duration: 1.2 }, '<')
    .to('.close', { clipPath: 'circle(50px at center)' }, '<')
    .to('.link', { rotate: '0deg', x: 0, y: 0, scale: 1, ease: 'Power2.easeOut', duration: 1.3 }, '<0.5')
    .to('.upper-header', { y: 40 }, '<')
}
const menuFunc = () =>
{
    closeNav.classList.toggle('close-opened')
    nav.classList.toggle('closed')
    document.documentElement.classList.toggle('menu-active')
}
const leaveNav = () =>
{
    tl.to('.link', { rotate: '-5deg', y: 150, ease: 'Power2.easeOut', duration: 1.3 })
    .to('.close', { clipPath: 'circle(0px at center)' }, '<0.3')
    .to('.menu-m', { yPercent: 0, ease: 'Power3.easeInOut', duration: 1.2 }, '<')
    .add(menuFunc, '<0.7')
    .to(nav, { clipPath: 'circle(50px at center)' }, '<')
    .to('.upper-header', { y: 0 }, '<')
}
closeNav.onclick = () => leaveNav()

const links = document.querySelectorAll('.link')
links.forEach(link => { link.onclick = () => leaveNav() })

const tick = () =>
{
    current.x = lerp(current.x, destination.x, 0.1)
    current.y = lerp(current.y, destination.y, 0.1)
    cursor.style.left = current.x + 'px'
    cursor.style.top = current.y + 'px'

    window.requestAnimationFrame(tick)
}
tick()