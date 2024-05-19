import "./bootstrap";

import.meta.glob(["../assets/img/**"]);
import Swal from "sweetalert2";

import Alpine from "alpinejs";

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();
