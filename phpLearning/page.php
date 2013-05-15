<?php 
/** 
分页类 
修改:Silence 
Creatdate:2006-5-30 
LastModify:2009-5-31 

使用方法 
$page = new page ( $result, 20 ); //$result为返回记录集数组 ,20为返回每页条数 
$index = $page->GetIndexBar () . $page->GetPageInfo (); 
print_r ( $result ); 
echo \"<br><br>\"; 
echo \"<center>\".$index.\"</center>\";

*/ 
class Page { 
private $mTotalRowsNum = 0; // 总信息行数 
private $mCurPageNumber = 1; // 当前所在页 
private $mTotalPagesNum = 1; // 总页数 
private $mQueryString; // 页面传递的数据(url?后的字符串) 
private $mPageRowsNum = 20; // 每页显示行数 
private $mIndexBarLength = 11; // 索引条的页数 
private $mIndexBar = ''; // 页码索引条 
private $mPageInfo = ''; // 分页信息 
// 页码索引条样式 
private $mNextButton = \"<font style=\\"font-family:webdings\\">8</font>\"; 
private $mPreButton = \"<font style=\\"font-family:webdings\\">7</font>\"; 
private $mFirstButton = \"<font style=\\"font-family:webdings\\">9</font>\"; 
private $mLastButton = \"<font style=\\"font-family:webdings\\">:</font>\"; 
private $mCssIndexBarCurPage = \"font-weight:bold;color:#FF0000\"; 
private $mCssIndexBarPage = ''; 
// 分页信息样式 
private $mCssPageInfoNumFont = 'color:#FF0000'; 
private $mCssPageInfoFont = ''; 

// 构造方法 
public function __construct(&$rSqlQuery, $userPageRowsNum = '') { 
if (! is_array ( $rSqlQuery )) { 
$this->SetDbPageBreak ( $rSqlQuery, $userPageRowsNum ); 
} else { 
$this->SetArrayPageBreak ( $rSqlQuery, $userPageRowsNum ); 
} 
} 

// 设置数据库型分页 
private function SetDbPageBreak(&$rSqlQuery, $userPageRowsNum = '') { 
$this->SetDbTotalRowsNum ( $rSqlQuery ); 
$this->SetTotalPagesNum ( $userPageRowsNum ); 
if ($this->mTotalPagesNum > 1) { 
$this->SetCurPageNumber (); 
$this->SetSqlQuery ( $rSqlQuery ); 
$this->SetQueryString (); 
$this->SetIndexBar (); 
$this->SetPageInfo (); 
} 
} 

// 设置数组型分页 
private function SetArrayPageBreak(&$rArray, $userPageRowsNum = '', $userTotalRowsNum = '') { 
$this->SetArrayTotalRowsNum ( $rArray, $userTotalRowsNum ); 
$this->SetTotalPagesNum ( $userPageRowsNum ); 
if ($this->mTotalPagesNum > 1) { 
$this->SetCurPageNumber (); 
$this->SetArray ( $rArray ); 
$this->SetQueryString (); 
$this->SetIndexBar (); 
$this->SetPageInfo (); 
} 
} 

// 数据库型计算总行数 
private function SetDbTotalRowsNum($rSqlQuery) { 
$this->mTotalRowsNum = mysql_num_rows ( mysql_query ( $rSqlQuery ) ); 
} 

// 数组型计算总行数 
private function SetArrayTotalRowsNum($array) { 
$this->mTotalRowsNum = count ( $array ); 
} 

// 计算总页数 
private function SetTotalPagesNum($userPageRowsNum = '') { 
if ($userPageRowsNum) { 
$this->mPageRowsNum = $userPageRowsNum; 
} 
$this->mTotalPagesNum = ( int ) (floor ( ($this->mTotalRowsNum - 1) / $this->mPageRowsNum ) + 1); 
} 

// 计算当前页数 
private function SetCurPageNumber() { 
if ($_GET ['page']) { 
$this->mCurPageNumber = $_GET ['page']; 
} 
} 

// 修正Sql截取语句 
private function SetSqlQuery(&$rSqlQuery) { 
$start_number = ($this->mCurPageNumber - 1) * $this->mPageRowsNum; 
$rSqlQuery .= \" LIMIT \" . $start_number . \",\" . $this->mPageRowsNum; 
} 

// 修正截取后的Array 
private function SetArray(&$rArray) { 
$start_number = ($this->mCurPageNumber - 1) * $this->mPageRowsNum; 
$rArray = array_slice ( $rArray, $start_number, $this->mPageRowsNum ); 
} 

// 修正 $_GET 传递数据 
private function SetQueryString() { 
$query_string = $_SERVER ['QUERY_STRING']; 
if ($query_string == '') { 
$this->mQueryString = \"?page=\"; 
} else { 
$this->mQueryString = preg_replace ( \"/&?page=\d+/\", '', $query_string ); 
$this->mQueryString = \"?\" . $this->mQueryString . \"&page=\"; 
} 
} 

// 设置页码索引条 
private function GetPageIndex() { 
if ($this->mTotalPagesNum <= $this->mIndexBarLength) { 
$first_number = 1; 
$last_number = $this->mTotalPagesNum; 
} else { 
$offset = ( int ) floor ( $this->mIndexBarLength / 2 ); 
if (($this->mCurPageNumber - $offset) <= 1) { 
$first_number = 1; 
} elseif (($this->mCurPageNumber + $offset) > $this->mTotalPagesNum) { 
$first_number = $this->mTotalPagesNum - $this->mIndexBarLength + 1; 
} else { 
$first_number = $this->mCurPageNumber - $offset; 
} 
$last_number = $first_number + $this->mIndexBarLength - 1; 
} 
$last_number; 
for($i = $first_number; $i <= $last_number; $i ++) { 
if ($this->mCurPageNumber == $i) { 
$page_index .= \"<font style='\" . $this->mCssIndexBarCurPage . \"'>\" . $i . \"</font> \"; 
} else { 
$page_index .= \" <a href='\" . $this->mQueryString . $i . \"' style='\" . $this->mCssIndexBarPage . \"'>\" . $i . \"</a> \"; 
} 
} 
return $page_index; 
} 

// 设置页码索引条 
private function SetIndexBar() { 
$this->mIndexBar = $this->GetNavFirstButton (); 
$this->mIndexBar .= $this->GetNavPreButton (); 
$this->mIndexBar .= $this->GetPageIndex (); 
$this->mIndexBar .= $this->GetNavNextButton (); 
$this->mIndexBar .= $this->GetNavLastButton (); 
} 

// 得到页码索引条 首页按钮 
private function GetNavFirstButton() { 
return \"<a href='\" . $this->mQueryString . \"1'>\" . $this->mFirstButton . \"</a> \"; 
} 

// 得到页码索引条 上一页按钮 
private function GetNavPreButton() { 
if ($this->mCurPageNumber > 1) { 
$pre_number = $this->mCurPageNumber - 1; 
} else { 
$pre_number = 1; 
} 
return \"<a href='\" . $this->mQueryString . $pre_number . \"'>\" . $this->mPreButton . \"</a> \"; 
} 

// 得到页码索引条 下一页按钮 
private function GetNavNextButton() { 
if ($this->mCurPageNumber < $this->mTotalPagesNum) { 
$next_number = $this->mCurPageNumber + 1; 
} else { 
$next_number = $this->mTotalPagesNum; 
} 
return \"<a href='\" . $this->mQueryString . $next_number . \"'>\" . $this->mNextButton . \"</a> \"; 
} 

// 得到页码索引条 末页按钮 
private function GetNavLastButton() { 
return \"<a href='\" . $this->mQueryString . $this->mTotalPagesNum . \"'>\" . $this->mLastButton . \"</a> \"; 
} 

// 设置分页信息 
private function SetPageInfo() { 
$this->mPageInfo = \"<font style='\" . $this->mCssPageInfoFont . \"'>\"; 
$this->mPageInfo .= \"共 <font style='\" . $this->mCssPageInfoNumFont . \"'>\" . $this->mTotalRowsNum . \"</font> 条信息 | \"; 
$this->mPageInfo .= \"<font style='\" . $this->mCssPageInfoNumFont . \"'>\" . $this->mPageRowsNum . \"</font> 条/页 | \"; 
$this->mPageInfo .= \"共 <font style='\" . $this->mCssPageInfoNumFont . \"'>\" . $this->mTotalPagesNum . \"</font> 页 | \"; 
$this->mPageInfo .= \"第 <font style='\" . $this->mCssPageInfoNumFont . \"'>\" . $this->mCurPageNumber . \"</font> 页\"; 
$this->mPageInfo .= \"</font>\"; 
} 

// 取出页码索引条 
public function GetIndexBar() { 
return $this->mIndexBar; 
} 

// 取出分页信息 
public function GetPageInfo() { 
return $this->mPageInfo; 
} 

//释放类 
function __destruct() { 

} 
} 
?> 
 