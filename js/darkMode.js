const html = document.querySelector('html')
const checkbox = document.querySelector("input[name=theme]")

const getStyle = (element, style) => 
    window
        .getComputedStyle(element)
        .getPropertyValue(style)


const initialColors = {
  bodyColor: getStyle(html, '--body-color'),
  headerColor: getStyle(html, '--header-color'),
  cancelColor: getStyle(html, '----cancel-color'),
  headerButton: getStyle(html, '--header-button'),
  colorWeekdays: getStyle(html, '--color-weekdays'),
  currentDay: getStyle(html, '--current-day'),
  eventColor: getStyle(html, '--event-color'),
  eventColor: getStyle(html, '--event-color'),
  colorDay: getStyle(html, '--color-day'),
  colorNumb: getStyle(html, '--color-numb'),
  modalEvent: getStyle(html, '--modal-event'),
  hover: getStyle(html, '--hover')
  

  
}

const darkMode = {
  bodyColor:'#282a36',
  colorNumb: '#fff',
  headerColor: '#3e56f3',
  cancelColor: '#FF0000',
  headerButton:'#1e38e6',
  colorWeekdays: '#fff',
  currentDay: '#5e61ffa4',
  eventColor: '#6272a4',
  colorDay: '#44475a',
  hover: '#5e61ffa4',
  modalEvent: '#6272a4'
  
}

const transformKey = key => 
    "--" + key.replace(/([A-Z])/, "-$1").toLowerCase()


const changeColors = (colors) => {
    Object.keys(colors).map(key => {
        html.style.setProperty(transformKey(key), colors[key]) 
        console.log(transformKey(key), colors[key])
      }
    )
    console.log(colors)
}



checkbox.addEventListener("change", ({target}) => {
    target.checked ? changeColors(darkMode) : changeColors(initialColors)
})



