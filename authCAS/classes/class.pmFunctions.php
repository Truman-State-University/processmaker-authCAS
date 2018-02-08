<?php
/**
 * class.authCAS.pmFunctions.php
 *
 * ProcessMaker Open Source Edition
 * Copyright (C) 2004 - 2008 Colosa Inc.
 * *
 */

////////////////////////////////////////////////////
// authCAS PM Functions
//
// Copyright (C) 2007 COLOSA
//
// License: LGPL, see LICENSE
////////////////////////////////////////////////////

function authCAS_getMyCurrentDate()
{
	return G::CurDate('Y-m-d');
}

function authCAS_getMyCurrentTime()
{
	return G::CurDate('H:i:s');
}
