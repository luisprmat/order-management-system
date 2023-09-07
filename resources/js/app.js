import './bootstrap';
import '@nextapps-be/livewire-sortablejs';

import Alpine from 'alpinejs';

import Swal from 'sweetalert2';

window.Alpine = Alpine;

window.Swal = Swal;

Alpine.store('pikaday', {
    dateLocale: {
        en: {
            previousMonth : 'Previous Month',
            nextMonth     : 'Next Month',
            months        : ['January','February','March','April','May','June','July','August','September','October','November','December'],
            weekdays      : ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
            weekdaysShort : ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']
        },
        es: {
            previousMonth : 'Mes anterior',
            nextMonth     : 'Mes siguiente',
            months        : ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            weekdays      : ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            weekdaysShort : ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb']
        }
    }
});

Alpine.start();
