<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_workflowGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select w.*  from v_wf_workflow_list w 
where exists ( 
select distinct x.p_workflow_id 
from v_wf_workflow_keyword x 
where x.p_workflow_id = w.p_workflow_id   
and UPPER(x.skeyword) like '%{s_keyword}%'
) 
" orderBy="p_workflow_id">
			<Components>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="lworkflow" fieldSource="lworkflow" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGridlworkflow">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="509" fieldSourceType="DBColumn" dataType="Text" html="False" name="lactive" fieldSource="lactive" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGridlactive">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="510" fieldSourceType="DBColumn" dataType="Text" html="False" name="cabang" fieldSource="cabang" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGridcabang">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="52" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="p_workflowGridDLink" hrefSource="p_wf_procedure.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="p_workflow_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="766" sourceType="DataField" name="p_workflow_id" source="p_workflow_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="54" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="p_workflowGridADLink" hrefSource="p_wf_procedure.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="p_workflow_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="767" sourceType="DataField" name="p_workflow_id" source="p_workflow_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="799" fieldSourceType="DBColumn" dataType="Text" html="False" name="ldocument" fieldSource="ldocument" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGridldocument">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_workflow_id" fieldSource="p_workflow_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_workflowGridp_workflow_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="763"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="129" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="786" conditionType="Parameter" useIsNull="False" field="upper(display_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="791" fieldName="decode(is_active,'Y','YA','TIDAK')" alias="is_active" isExpression="True"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="798" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_workflowSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_wf_procedure.ccp" PathID="p_workflowSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_workflowSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_workflowSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="688" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_wf_procmasterGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_wf_chart_prev">
			<Components>
				<Label id="693" fieldSourceType="DBColumn" dataType="Text" html="False" name="proc_display_prev" fieldSource="proc_display_prev" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGridproc_display_prev">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="694" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="695" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_procedure_id_prev" fieldSource="p_procedure_id_prev" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_wf_procmasterGridp_procedure_id_prev">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="739" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_workflow_id" fieldSource="p_workflow_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_wf_procmasterGridp_workflow_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="689" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link2" hrefSource="p_wf_proc_list1.ccp" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_wf_procmasterGridInsert_Link2" removeParameters="p_wf_procedure_id;prev_procedure_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="690" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
						<LinkParameter id="754" sourceType="Expression" name="p_workflow_id" source="CCGetFromGet(&quot;p_workflow_id&quot;.&quot;&quot;)"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="755" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="p_wf_procmasterGridDLink" hrefSource="p_wf_procedure.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="p_procedure_id_prev">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="802" sourceType="DataField" name="p_procedure_id_prev" source="p_procedure_id_prev"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="757" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="p_wf_procmasterGridADLink" hrefSource="p_wf_procedure.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="p_procedure_id_prev">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="803" sourceType="DataField" name="p_procedure_id_prev" source="p_procedure_id_prev"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="701" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="764"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="801" conditionType="Parameter" useIsNull="False" field="p_workflow_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_workflow_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="800" tableName="v_wf_chart_prev" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="708" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="709" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_wf_procmasterGrid2" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_wf_chart_next">
			<Components>
				<Navigator id="715" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="717" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="718" fieldSourceType="DBColumn" dataType="Text" html="False" name="proc_display_next" fieldSource="proc_display_next" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2proc_display_next">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="719" fieldSourceType="DBColumn" dataType="Text" html="False" name="linitchild" fieldSource="linitchild" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2linitchild">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="720" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="710" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link3" hrefSource="p_wf_proc_list1.ccp" removeParameters="p_w_chart_proc_id_next" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_wf_procmasterGrid2Insert_Link3">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="776" sourceType="DataField" name="p_procedure_id_prev" source="p_procedure_id_prev"/>
						<LinkParameter id="775" sourceType="DataField" format="yyyy-mm-dd" name="p_workflow_id" source="p_workflow_id"/>
						<LinkParameter id="810" sourceType="DataField" name="pekerjaan_prev" source="proc_display_prev"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<ImageLink id="752" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_wf_procmasterGrid2ImageLink1" hrefSource="p_wf_proc_list2.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="753" sourceType="DataField" name="p_workflow_id" source="p_workflow_id"/>
						<LinkParameter id="773" sourceType="DataField" name="p_w_chart_proc_id" source="p_w_chart_proc_id_next"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Link id="759" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="p_wf_procmasterGrid2DLink" hrefSource="p_wf_procedure.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="p_w_chart_proc_id_next">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="809" sourceType="DataField" name="p_w_chart_proc_id_next" source="p_w_chart_proc_id_next"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="761" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="p_wf_procmasterGrid2ADLink" hrefSource="p_wf_procedure.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="p_w_chart_proc_id_next">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="808" sourceType="DataField" name="p_w_chart_proc_id_next" source="p_w_chart_proc_id_next"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="772" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_procedure_id_prev" fieldSource="p_procedure_id_prev" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2p_procedure_id_prev">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="716" fieldSourceType="DBColumn" dataType="Float" name="p_w_chart_proc_id_next" fieldSource="p_w_chart_proc_id_next" PathID="p_wf_procmasterGrid2p_w_chart_proc_id_next">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="779" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_workflow_id" fieldSource="p_workflow_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2p_workflow_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ImageLink id="106" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink2" PathID="p_wf_procmasterGrid2ImageLink2" hrefSource="p_w_daemon_proc.ccp" removeParameters="s_keyword">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="811" sourceType="DataField" name="doc_name" source="doc_name"/>
						<LinkParameter id="812" sourceType="DataField" name="p_w_chart_proc_id" source="p_w_chart_proc_id_next"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="777" fieldSourceType="DBColumn" dataType="Text" html="False" name="lvalid" fieldSource="lvalid" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2lvalid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="722" styles="Row;AltRow" name="rowStyle"/>
						<Action actionName="Custom Code" actionCategory="General" id="765"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="805" conditionType="Parameter" useIsNull="False" field="p_procedure_id_prev" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_procedure_id_prev"/>
				<TableParameter id="806" conditionType="Parameter" useIsNull="False" field="p_workflow_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_workflow_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="804" tableName="v_wf_chart_next" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="729" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_wf_procedure_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_wf_procedure.php" forShow="True" url="p_wf_procedure.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
	</Events>
</Page>
