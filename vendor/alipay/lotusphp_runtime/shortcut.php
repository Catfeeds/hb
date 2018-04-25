<?php
//--陶---与TP的C方法重名，修改为CN---
// function C($className)
// {
// 	return LtObjectUtil::singleton($className);
// }
function CN($className)
{
	return LtObjectUtil::singleton($className);
}
