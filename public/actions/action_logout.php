<?php
session_start();
session_destroy();

header('Location: ../login-screen.html?msg=' . urlencode('Você saiu!'));