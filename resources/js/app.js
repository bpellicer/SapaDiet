import './bootstrap';

"use strict";

$("navbarBtn").on("click", toggleMenu())

function toggleMenu() {
    const navToggle = $(".toggle");
    for (let i = 0; i < navToggle.length; i++) {
      navToggle.item(i).classList.toggle("hidden");
    }
  };
