<?php
/**
 * WeisiteCms数据模型
 */
class WeisiteCmsTable {
	// 数据表模型配置
	public $config = [
			'name' => 'weisite_cms',
			'title' => '文章管理',
			'search_key' => 'title',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 20
	];
	
	// 列表定义
	public $list_grid = [
			'keyword' => [
					'title' => '关键词',
					'function' => '',
					'width' => '',
					'sort' => '',
					'href' => [ ]
			],
			'keyword_type' => [
					'title' => '关键词类型',
					'function' => '',
					'width' => '',
					'sort' => '',
					'href' => [ ]
			],
			'title' => [
					'title' => '标题',
					'function' => '',
					'width' => '',
					'sort' => '',
					'href' => [ ]
			],
			'cate_id' => [
					'title' => '所属分类',
					'function' => '',
					'width' => '',
					'sort' => '',
					'href' => [ ]
			],
			'sort' => [
					'title' => '排序号',
					'function' => '',
					'width' => '',
					'sort' => '',
					'href' => [ ]
			],
			'view_count' => [
					'title' => '浏览数',
					'function' => '',
					'width' => '',
					'sort' => '',
					'href' => [ ]
			],
			'ids' => [
					'title' => '操作',
					'function' => '',
					'width' => '',
					'sort' => '',
					'href' => [
							'0' => [
									'title' => '编辑',
									'url' => '[EDIT]&module_id=[pid]'
							],
							'1' => [
									'title' => '删除',
									'url' => '[DELETE]'
							]
					]
			]
	];
	
	// 字段定义
	public $fields = [
			'id' => [
					'title' => '主键',
					'field' => 'int(10) unsigned NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'keyword' => [
					'title' => '关键词',
					'field' => 'varchar(100) NOT NULL',
					'type' => 'string',
					'is_show' => 1,
					'is_must' => 1
			],
			'keyword_type' => [
					'title' => '关键词类型',
					'field' => 'tinyint(2) NULL',
					'type' => 'select',
					'is_show' => 1,
					'extra' => '0:完全匹配
1:左边匹配
2:右边匹配
3:模糊匹配
4:正则匹配
5:随机匹配'
			],
			'title' => [
					'title' => '标题',
					'field' => 'varchar(255) NOT NULL',
					'type' => 'string',
					'is_show' => 1,
					'is_must' => 1
			],
			'intro' => [
					'title' => '简介',
					'field' => 'text NULL',
					'type' => 'textarea',
					'is_show' => 1
			],
			'cate_id' => [
					'title' => '所属类别',
					'field' => 'int(10) unsigned NULL',
					'type' => 'select',
					'value' => 0,
					'remark' => '要先在微官网分类里配置好分类才可选择',
					'is_show' => 1,
					'extra' => '0:请选择分类'
			],
			'cover' => [
					'title' => '封面图片',
					'field' => 'int(10) unsigned NULL',
					'type' => 'picture',
					'is_show' => 1
			],
			'content' => [
					'title' => '内容',
					'field' => 'text NULL',
					'type' => 'editor',
					'is_show' => 1
			],
			'cTime' => [
					'title' => '发布时间',
					'field' => 'int(10) NULL',
					'type' => 'datetime',
					'auto_rule' => 'time',
					'auto_time' => 1,
					'auto_type' => 'function'
			],
			'sort' => [
					'title' => '排序号',
					'field' => 'int(10) unsigned NULL',
					'type' => 'num',
					'value' => 0,
					'remark' => '数值越小越靠前',
					'is_show' => 1
			],
			'view_count' => [
					'title' => '浏览数',
					'field' => 'int(10) unsigned NULL',
					'type' => 'num',
					'value' => 0
			]
	];
}	