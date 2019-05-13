<?php # setupsqlmaintainout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$bpmn2source = $_REQUEST['BPMN2SOURCE'];$bpmn2source = str_replace('<', '|<', $bpmn2source);XH1("BPMN2 Documenter");$sourcea = explode('|',$bpmn2source);$laneid2lanenamea = Array();   // key lanename | value laneid$laneid2noderefa = Array();   // key laneid | value Array of noderefs$noderef2titlea = Array();   // key noderef | value title$noderef2documentationa = Array();   // key noderef | value description$noderef2xa = Array();   // key noderef | value description$tlanenodea = Array();foreach ($sourcea as $sourceelement) {		// <bpmn2:lane id="Lane_4" name="Remedy Hub">	if (strlen(stristr($sourceelement,'<bpmn2:lane id'))>0) {		// XPTXT("--------"."bpmn2:lane id");			$lbits  = explode('"',$sourceelement);		$thislaneid = $lbits[1];		$thislanename = $lbits[3];		// XPTXT($thislaneid."=".$thislanename);		$laneid2lanenamea[$thislaneid] = $thislanename;		$tlanenodea = Array(); // reset Array of nodes in lane	}		// <bpmn2:flowNodeRef>InclusiveGateway_1</bpmn2:flowNodeRef>	if (strlen(stristr($sourceelement,'<bpmn2:flowNodeRef'))>0) {		// XPTXT("--------"."bpmn2:flowNodeRef");		$lbits  = explode('>',$sourceelement);		$mbits  = explode('<',$lbits[1]);		array_push($tlanenodea,$mbits[0]);		// XPTXT($mbits[0]);	}			// </bpmn2:lane>		if (strlen(stristr($sourceelement,'</bpmn2:lane>'))>0) {		// XPTXT("--------"."/bpmn2:lane"." ".$thislaneid);		// print_r($tlanenodea);		$laneid2noderefa[$thislaneid] = $tlanenodea;		$tlanenodea = Array();	}			// <bpmn2:serviceTask id="ServiceTask_9" name="Video Conference App">		if ((strlen(stristr($sourceelement,'<bpmn2:serviceTask id'))>0) 		||(strlen(stristr($sourceelement,'<bpmn2:userTask id'))>0)			||(strlen(stristr($sourceelement,'<bpmn2:inclusiveGateway id'))>0)		||(strlen(stristr($sourceelement,'<bpmn2:parallelGateway id'))>0)) {		$lbits  = explode('"',$sourceelement);		// XPTXT("--------");		$thisnoderef = $lbits[1];		$noderef2titlea[$thisnoderef] = $lbits[3];		// XPTXT($thisnoderef." = ".$lbits[3]);	}		// <bpmn2:documentation id="Documentation_196">The Simple Apology Remedy case is now closed</bpmn2:documentation>	// <bpmn2:documentation id="Documentation_180">	// <![CDATA[The Offender accesses the Payment App and makes a payment if the Remedy requires one.]]>	// </bpmn2:documentation>	if (strlen(stristr($sourceelement,'<bpmn2:documentation id'))>0) {		$lbits  = explode('>',$sourceelement);		$mbits  = explode('<',$lbits[1]);		$documentation = $mbits[0];		$noderef2documentationa[$thisnoderef] = $documentation;		// XPTXT("XXX".$thisnoderef." = ".$documentation);	}	if (strlen(stristr($sourceelement,'<![CDATA['))>0) {				$sourceelement = str_replace('<![CDATA[', '', $sourceelement);		$sourceelement = str_replace(']]>', '', $sourceelement);		$documentation = $sourceelement;				$noderef2documentationa[$thisnoderef] = $documentation;		// XPTXT("ZZZ".$thisnoderef." = ".$documentation);	}		// <bpmndi:BPMNShape id="BPMNShape_ServiceTask_3" bpmnElement="ServiceTask_3" isExpanded="true">	if (strlen(stristr($sourceelement,'<bpmndi:BPMNShape id'))>0) {		$lbits  = explode('"',$sourceelement);		$thisnoderef = $lbits[3];		$lookforx = "1";	}			// <dc:Bounds height="50.0" width="81.0" x="510.0" y="547.0"/>	if ((strlen(stristr($sourceelement,'<dc:Bounds'))>0)&&($lookforx == "1")) {		$lbits  = explode('"',$sourceelement);		$thisx = $lbits[5];		$noderef2xa[$thisnoderef] = $thisx;		$lookforx = "0";	}	}/*XHR();print_r($laneid2lanenamea);XHR();print_r($noderef2titlea);XHR();print_r($noderef2documentationa);XHR();*/foreach ($laneid2lanenamea as $laneid => $lanename) {	XHR();	XH2($lanename);	if( count( $laneid2noderefa[$laneid] ) > 0 ) {		$lanetaska = Array();		foreach ($laneid2noderefa[$laneid] as $noderef) {			$tempx = intval($noderef2xa[$noderef]);			$sortseq = substr("000000".$tempx, -6);;						array_push($lanetaska,$sortseq."|".$noderef);		}				sort($lanetaska);		// print_r($lanetaska);				foreach ($lanetaska as $element) {			$ebits = explode('|',$element);			XH4($noderef2titlea[$ebits[1]]);			XPTXT($noderef2documentationa[$ebits[1]]);		}			}	}	
Back_Navigator();
PageFooter("Default","Final");
?>