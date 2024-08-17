function useState(element, key, initial) {
    let stateValue = element.getAttribute(key) ?? initial;
    element.setAttribute(key, stateValue);

    return {
        get value() {
            return stateValue
        },
        set value(newVal) {
            stateValue = newVal;
            element.setAttribute(key, stateValue);
        }
    }
}
function formatNumber(input) {
    let value = input.value;

    let isNegative = value.startsWith('-');

    value = value.replace(/\D/g, '');

    if (isNegative) {
        value = '-' + value;
    }

    let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    input.value = formattedValue;
}


const STATE_ATTRIBUTE = 'data-dropdown-state';
const TARGET_ATTRIBUTE = 'data-dropdown-target';

const ON = '1';
const OFF = '0';

function toggleDropdown(targetElement) {
    const state = useState(targetElement, STATE_ATTRIBUTE, OFF);
    const dropdownContainerTarget = targetElement.getAttribute(TARGET_ATTRIBUTE);
    const dropdownContainerElement = document.querySelector(dropdownContainerTarget);
    const iconElement = targetElement.querySelector('[data-dropdown-icon]');

    if (state.value == ON) {
        state.value = OFF;

        if (iconElement != null)
            iconElement.classList.remove('rotate-90');

        dropdownContainerElement.classList.remove('absolute', 'opacity-0', 'pointer-events-none');

        return;
    }

    if (iconElement != null)
        iconElement.classList.add('rotate-90');

    dropdownContainerElement.classList.add('absolute', 'opacity-0', 'pointer-events-none');

    state.value = ON;
}

const dropdownButtons = document.querySelectorAll('[data-dropdown-target]');
dropdownButtons.forEach((dropdownButton) => {
    dropdownButton.addEventListener('click', () => {
        dropdownButtons.forEach((button) => {
            if (button == dropdownButton) {
                return;
            }

            const state = useState(button, STATE_ATTRIBUTE, OFF);
            if (state.value == OFF) {
                toggleDropdown(button);
            }
        })

        toggleDropdown(dropdownButton)
    });

    toggleDropdown(dropdownButton); // simulate event
});


const inputFormat = document.querySelectorAll('[data-format-number]');
inputFormat.forEach((input) => formatNumber(input))

const sidebarHamburger = document.querySelector('#sidebar-hamburger');
const sidebarElement = document.querySelector('#sidebar-element');
sidebarHamburger.addEventListener('click', () => {
    const sidebar = useState(sidebarHamburger, 'sidebar', false);

    if (sidebar.value == ON) {
        sidebar.value = OFF;
        sidebarElement.classList.remove('sidebar-hidden')

    } else {
        sidebar.value = ON;
        sidebarElement.classList.add('sidebar-hidden')
    }
})

function updateOngkir (total, bobot) {
    const select = document.querySelector("#ongkir")
    const hargaOngkir = select.options[select.selectedIndex].getAttribute('data-harga');
    const bobotBersih = bobot < 1000 ? 1 : bobot / 1000;
    const update = document.querySelector("#totalBayar")
    update.textContent = new Intl.NumberFormat().format(bobotBersih * hargaOngkir + total);
}

function updateTotalBayar(e, harga) {
    const update = document.querySelector("#totalBayar")
    update.textContent = new Intl.NumberFormat().format(e.value * harga);
}
