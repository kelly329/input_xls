<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
   
   /**
	 *
	 * Enter 导出excel共同方法 ...
	 * @param unknown_type $expTitle
	 * @param unknown_type $expCellName
	 * @param unknown_type $expTableData
	 */
	function  index(){
		$this->display();
	}
	public function exportExcel($expTitle,$expCellName,$expTableData){
		$xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
		$fileName = $_SESSION['account'].date('YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
		$cellNum = count($expCellName);
		$dataNum = count($expTableData);

		vendor("PHPExcel.PHPExcel");
			
		$objPHPExcel = new \PHPExcel();
		$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

		$objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
		for($i=0;$i<$cellNum;$i++){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
		}
		// Miscellaneous glyphs, UTF-8
		for($i=0;$i<$dataNum;$i++){
			for($j=0;$j<$cellNum;$j++){
				$objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
			}
		}

		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
		header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}

	/**
	 *
	 * 导出Excel
	 */
	function expUser(){//导出Excel
		$xlsName  = "User";
		$xlsCell  = array(
		array('id','账号序列'),
		array('name','名字'),
		array('birth','出生年'),
		array('create_time','创建时间'),
		array('status','状态'),
		
		);
		$xlsModel = M('New');

		$xlsData  = $xlsModel->Field('id,name,birth,create_time,status')->select();
		// foreach ($xlsData as $k => $v)
		// {
		// 	$xlsData[$k]['sex']=$v['sex']==1?'男':'女';
		// }
		$this->exportExcel($xlsName,$xlsCell,$xlsData);
			
	}
	/**
	 *
	 * 显示导入页面 ...
	 */

	/**实现导入excel
	 **/
   function impUser(){
		if (!empty($_FILES)) {
			//import("@.ORG.UploadFile");
			$config=array(
                'exts'=>array('xlsx','xls'),
                'rootPath'=>"./Public/",
                'savePath'=>'Uploads/',
                //'autoSub'    =>    true,
                'subName'    =>    array('date','Ymd'),
			);
			$upload = new \Think\Upload($config);
			//var_dump($upload);exit;
            if (!$info=$upload->upload()) {
                $this->error($upload->getError());
			} /*else {
				//$info = $upload->getUploadFileInfo();
                  
			}
            */
            //var_dump($_FILES);exit;
			vendor("PHPExcel.PHPExcel");
			$file_name=$upload->rootPath.$info['import']['savepath'].$info['import']['savename'];
			//var_dump($file_name);exit;
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow(); // 取得总行数
			$highestColumn = $sheet->getHighestColumn(); // 取得总列数
			for($i=3;$i<=$highestRow;$i++)
			{
				
				$data['id'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
				$data['name'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
				$data['birth']= $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
				$data['create_time']= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
				$data['status']= $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
				
				M('New')->add($data);
					
			}
			$this->success('导入成功！');
		}else
		{
			$this->error("请选择上传的文件");
		}
			

	}

  


}