<?php

namespace Addons\Exam\Controller;

use Think\ManageBaseController;

class AnswerController extends ManageBaseController {
	var $model;
	var $exam_id;
	function _initialize() {
		parent::_initialize ();
		
		$this->model = $this->getModel ( 'exam_answer' );
		
		$param ['exam_id'] = $this->exam_id = intval ( $_REQUEST ['exam_id'] );
		
		$res ['title'] = '微考试';
		$res ['url'] = addons_url ( 'Exam://Exam/lists' );
		$res ['class'] = '';
		$nav [] = $res;
		
		$res ['title'] = '数据管理';
		$res ['url'] = addons_url ( 'Exam://Answer/lists', $param );
		$res ['class'] = 'current';
		$nav [] = $res;
		
		$this->assign ( 'nav', $nav );
	}
	// 通用插件的列表模型
	public function lists() {
		$this->assign ( 'add_button', false );
		$this->assign ( 'search_button', false );
		$this->assign ( 'del_button', false );
		$this->assign ( 'check_all', false );
		
		// 解析列表规则
		$data = $this->_list_grid ( $this->model );
		// dump ( $data );
		
		$this->assign ( $data );
		
		// 搜索条件
		$map = $this->_search_map ( $this->model, $data ['fields'] );
		$data ['fields'] [] = 'uid';
		$data ['fields'] [] = 'sum(score) as total';
		
		$name = parse_name ( get_table_name ( $this->model ['id'] ), true );
		$list = M ( $name )->where ( $map )->field ( $data ['fields'] )->order ( 'id DESC' )->group ( 'uid' )->selectPage ();
		
		$dataTable = D ( 'Common/Model' )->getFileInfo ( $this->model );
		$list ['list_data'] = $this->parseData ( $list ['list_data'], $dataTable->fields, $dataTable->list_grid, $dataTable->config );
		foreach ( $list ['list_data'] as &$vo ) {
			$member = get_userinfo ( $vo ['uid'] );
			$vo ['truename'] = $member ['truename'] ? $member ['truename'] : $member ['nickname'];
			$vo ['mobile'] = $member ['mobile'];
			$vo ['score'] = $vo ['total'];
		}
		
		$this->assign ( $list );
		
		$this->display ();
	}
	function detail() {
		$this->assign ( 'add_button', false );
		$this->assign ( 'search_button', false );
		$this->assign ( 'del_button', false );
		$this->assign ( 'check_all', false );
		
		// 解析列表规则
		$fields [] = 'question';
		$fields [] = 'answer';
		
		$girds ['field'] = 'question';
		$girds ['title'] = '题目';
		$list_data ['list_grids'] [] = $girds;
		
		$girds ['field'] = 'answer';
		$girds ['title'] = '回答内容';
		$list_data ['list_grids'] [] = $girds;
		
		$list_data ['fields'] = $fields;
		$this->assign ( $list_data );
		// dump ( $list_data );
		$map ['exam_id'] = intval ( $_REQUEST ['exam_id'] );
		$questions = M ( 'exam_question' )->where ( $map )->select ();
		foreach ( $questions as $q ) {
			$title [$q ['id']] = $q ['title'];
			$type [$q ['id']] = $q ['type'];
			$extra [$q ['id']] = parse_config_attr ( $q ['extra'] );
		}
		
		$map ['uid'] = intval ( $_REQUEST ['uid'] );
		$answers = M ( 'exam_answer' )->where ( $map )->select ();
		foreach ( $answers as $a ) {
			$qid = $a ['question_id'];
			$data [0] = $title [$qid];
			$value = unserialize ( $a ['answer'] );
			switch ($type [$qid]) {
				case 'radio' :
					$data [1] = $extra [$qid] [$value];
					break;
				case 'checkbox' :
					foreach ( $value as $v ) {
						$data [1] [] = $extra [$qid] [$v];
					}
					$data [1] = implode ( ',', $data ['answer'] );
					break;
				default :
					$data [1] = $value;
			}
			$list [] = $data;
			unset ( $data );
		}
		$this->assign ( 'list_data', $list );
		// dump ( $list );
		
		$this->display ( T ( 'Addons/lists' ) );
	}
	
	// 通用插件的删除模型
	public function del() {
		parent::common_del ( $this->model );
	}
}
