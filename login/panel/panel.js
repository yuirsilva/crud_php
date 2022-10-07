const mobileMenu = document.querySelector('.panel-mobile-menu')
const sidebar = document.querySelector('.sidebar-menu')
let flagg = true

// mobile click
mobileMenu.onclick = () =>
{
    if(flagg) {
        sidebar.style.visibility = 'visible'
        sidebar.style.transform = 'translateX(0%)'
        mobileMenu.children[0].style.transform = 'translateX(100%)'
        mobileMenu.children[1].style.transform = 'translateY(-200%)'
        flagg = false
    } else {
        sidebar.style.transform = 'translateX(-100%)'
        mobileMenu.children[0].style.transform = 'translateX(0%)'
        mobileMenu.children[1].style.transform = 'translateY(0%)'
        flagg = true
    }
}

const lerp = (start, end, amt) =>
{
    return (1.0 - amt)*start+amt*end
}

const tick = () =>
{
    current.x = lerp(current.x, destination.x, 0.1)
    current.y = lerp(current.y, destination.y, 0.1)
    cursor.style.left = current.x + 'px'
    cursor.style.top = current.y + 'px'

    window.requestAnimationFrame(tick)
}
tick()

// hide/show buttons
const resumeAdditionalBtnsWrapper = document.querySelectorAll('.resume-additional-btns-wrapper')

const openedEye = document.querySelectorAll('.hide-eye')

function addTrashIcon()
{
    const trashIconDiv = document.createElement('div')
    const trashIcon = new Image()
    trashIcon.src = './img/trash.svg'
    trashIconDiv.classList.add('trashIcon')

    trashIconDiv.appendChild(trashIcon)

    return trashIconDiv
}

// hover and remove additional info
const infoArray = [document.querySelectorAll('.ability'), document.querySelectorAll('.competence'), document.querySelectorAll('.educations .information-block'), document.querySelectorAll('.professional-experiences .information-block')]
infoArray.forEach(item =>
{
    item.forEach(subItem => {
        subItem.addEventListener('mouseenter', () => {
            subItem.appendChild(addTrashIcon())
        })
        subItem.addEventListener('mouseleave', () => {
            subItem.removeChild(subItem.lastElementChild)
        })
        subItem.addEventListener('click', () => {
            subItem.remove()
            const attrName = subItem.attributes[0].name
            const attrValue = subItem.attributes[0].value
            const formData = new FormData()
            const url = './delete.php'

            formData.append('attrName', attrName)
            formData.append('attrValue', attrValue)

            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .catch((err) => console.log(err))
        })
    })
})

openedEye.forEach(eye =>
{
    const eyesArray = [eye.previousElementSibling, eye]

    eyesArray.forEach(clickedEye => {
        clickedEye.addEventListener('click', () => {
            clickedEye.classList.toggle('hide-eye')

            let elementSibling = clickedEye.nextElementSibling
            let parentElement = clickedEye.parentElement
            parentElement.classList.toggle('resume-additional-btns-clicked')

            parentElement.previousElementSibling.classList.toggle('information-hover')

            if(elementSibling === null) {
                elementSibling = clickedEye.previousElementSibling
            }
            elementSibling.classList.toggle('hide-eye')
        })
    })
})