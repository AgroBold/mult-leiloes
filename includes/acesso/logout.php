<?php

@session_start();
include("../../config/config.php");

session_destroy();
session_unset();

retorno_usuario('success', "Logout realizado com Sucesso!");
