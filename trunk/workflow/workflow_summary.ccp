<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\workflow" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="476" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="sumworkflow" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from pack_task_profile.workflow_summary_list({test},'{puser}')
where p_w_doc_type_id = {test}">
			<Components>
				<Label id="479" fieldSourceType="DBColumn" dataType="Text" html="True" name="DISPLAY_NAME" fieldSource="display_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="sumworkflowDISPLAY_NAME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="480" fieldSourceType="DBColumn" dataType="Text" html="False" name="SCOUNT" fieldSource="scount" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="sumworkflowSCOUNT">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="483" fieldSourceType="DBColumn" dataType="Text" name="STYPE" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="sumworkflowSTYPE" fieldSource="stype">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="14" visible="Dynamic" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="True" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" wizardThemeItem="GridA" PathID="sumworkflowDLink" hrefSource="workflow_summary.ccp" removeParameters="IS_TAKEN">
					<Components/>
					<Events>
					</Events>
					<LinkParameters>
						<LinkParameter id="488" sourceType="DataField" format="yyyy-mm-dd" name="ELEMENT_ID" source="element_id"/>
						<LinkParameter id="84" sourceType="DataField" name="P_W_DOC_TYPE_ID" source="p_w_doc_type_id"/>
						<LinkParameter id="85" sourceType="DataField" name="P_W_PROC_ID" source="p_w_proc_id"/>
						<LinkParameter id="86" sourceType="DataField" name="PROFILE_TYPE" source="profile_type"/>
						<LinkParameter id="87" sourceType="DataField" name="P_APP_USER_ID" source="p_app_user_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="12" visible="Dynamic" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="True" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" wizardThemeItem="GridA" PathID="sumworkflowADLink" hrefSource="workflow_summary.ccp" removeParameters="IS_TAKEN">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="13" sourceType="DataField" name="ELEMENT_ID" source="element_id"/>
						<LinkParameter id="80" sourceType="DataField" name="P_W_DOC_TYPE_ID" source="p_w_doc_type_id"/>
						<LinkParameter id="81" sourceType="DataField" name="P_W_PROC_ID" source="p_w_proc_id"/>
						<LinkParameter id="82" sourceType="DataField" name="PROFILE_TYPE" source="profile_type"/>
						<LinkParameter id="83" sourceType="DataField" name="P_APP_USER_ID" source="p_app_user_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="489" fieldSourceType="DBColumn" dataType="Text" name="ELEMENT_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="sumworkflowELEMENT_ID" fieldSource="element_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="484" styles="Row;AltRow" name="rowStyle"/>
						<Action actionName="Custom Code" actionCategory="General" id="492"/>
</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="486" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="490" variable="puser" parameterType="Expression" defaultValue="&quot;ADMIN&quot;" dataType="Text" designDefaultValue="ADMIN" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="491" variable="test" parameterType="URL" defaultValue="-9" dataType="Float" designDefaultValue="1" parameterSource="P_W_DOC_TYPE_ID"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="19" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="TaskSearch" errorSummator="Error" wizardCaption="Add/Edit P Module " wizardFormMethod="post" PathID="TaskSearch" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="DSQLParameters" activeTableType="customDelete" parameterTypeListName="ParameterTypeList" returnPage="workflow_summary.ccp">
			<Components>
				<TextBox id="494" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="sdonor_date" wizardCaption="DATE OF BIRTH" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="TaskSearchsdonor_date" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="99" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="P_W_DOC_TYPE_ID" required="False" caption="P_W_DOC_TYPE_ID" wizardCaption="DATE OF BIRTH" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="TaskSearchP_W_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="100" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="P_W_PROC_ID" required="False" caption="P_W_PROC_ID" wizardCaption="DATE OF BIRTH" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="TaskSearchP_W_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="101" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ELEMENT_ID" required="False" caption="ELEMENT_ID" wizardCaption="DATE OF BIRTH" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="TaskSearchELEMENT_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="495" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="TaskSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Button id="496" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="TaskSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
<DatePicker id="34" name="DatePicker_sdonor_date" control="sdonor_date" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="TaskSearchDatePicker_sdonor_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
</Components>
			<Events/>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="493" fieldName="*"/>
</Fields>
			<ISPParameters/>
			<ISQLParameters>
			</ISQLParameters>
			<IFormElements>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
<Grid id="16" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="Task" pageSizeLimit="100" wizardCaption="List of Grid1 " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" pasteAsReplace="pasteAsReplace" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from pack_task_profile.user_task_list ({pdoctype_id},{pproc_id},'{pprof_type}','{puser}','{skeyword}') 
where trunc(donor_date) = nvl(to_date('{sdonor_date}','DD-MON-YYYY'),trunc(donor_date)) 
and keyword like '%{s_keyword}%' ">
			<Components>
				<Sorter id="23" visible="True" name="Sorter_LTASK" column="LTASK" wizardCaption="LTASK" wizardSortingType="SimpleDir" wizardControl="LTASK" wizardAddNbsp="False" PathID="TaskSorter_LTASK">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="24" visible="True" name="Sorter_DOC_NO" column="DOC_NO" wizardCaption="DOC NO" wizardSortingType="SimpleDir" wizardControl="DOC_NO" wizardAddNbsp="False" PathID="TaskSorter_DOC_NO">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" name="MESSAGE" fieldSource="message" wizardCaption="MESSAGE" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskMESSAGE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="57" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="58" urlType="Relative" enableValidation="True" isDefault="False" name="Buka" PathID="TaskBuka">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="128" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes>
						<Attribute id="132" name="taskbuka"/>
						<Attribute id="133" name="read"/>
					</Attributes>
					<Features/>
				</Button>
				<TextBox id="73" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="DOC_ID" PathID="TaskDOC_ID" fieldSource="doc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="74" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="P_W_DOC_TYPE_ID" PathID="TaskP_W_DOC_TYPE_ID" fieldSource="p_w_doc_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="75" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="P_W_PROC_ID" PathID="TaskP_W_PROC_ID" fieldSource="p_w_proc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="76" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="PROFILE_TYPE" PathID="TaskPROFILE_TYPE" fieldSource="profile_type">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="78" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="FILENAME" PathID="TaskFILENAME" fieldSource="filename">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="43" fieldSourceType="DBColumn" dataType="Text" html="False" name="LTASK" fieldSource="ltask" wizardCaption="LTASK" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskLTASK">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="46" fieldSourceType="DBColumn" dataType="Text" html="False" name="RECIPIENT" fieldSource="recipient" wizardCaption="RECIPIENT" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskRECIPIENT">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="47" fieldSourceType="DBColumn" dataType="Text" html="False" name="SENDER" fieldSource="sender" wizardCaption="SENDER" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskSENDER">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="51" fieldSourceType="DBColumn" dataType="Text" html="False" name="DONOR_DATE" fieldSource="donor_date" wizardCaption="DONOR DATE" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskDONOR_DATE" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" name="TAKEOVER" fieldSource="takeover" wizardCaption="TAKEOVER" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskTAKEOVER">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="52" fieldSourceType="DBColumn" dataType="Text" html="False" name="TAKEN_DATE" fieldSource="taken_date" wizardCaption="TAKEN DATE" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskTAKEN_DATE" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="49" fieldSourceType="DBColumn" dataType="Text" html="False" name="CLOSER" fieldSource="closer" wizardCaption="CLOSER" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskCLOSER">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="53" fieldSourceType="DBColumn" dataType="Text" html="False" name="SUBMIT_DATE" fieldSource="submit_date" wizardCaption="SUBMIT DATE" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskSUBMIT_DATE" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="55" fieldSourceType="DBColumn" dataType="Text" html="False" name="LPROC_STS" fieldSource="proc_sts" wizardCaption="PROC STS" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskLPROC_STS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="44" fieldSourceType="DBColumn" dataType="Text" html="False" name="LDOC_NO" fieldSource="doc_no" wizardCaption="DOC NO" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskLDOC_NO">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="45" fieldSourceType="DBColumn" dataType="Float" html="False" name="PERIOD" fieldSource="period" wizardCaption="PERIOD" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="TaskPERIOD">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="50" fieldSourceType="DBColumn" dataType="Text" html="False" name="READ_DATE" fieldSource="read_date" wizardCaption="READ DATE" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskREAD_DATE" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="54" fieldSourceType="DBColumn" dataType="Text" html="False" name="LDOC_STS" fieldSource="ldoc_sts" wizardCaption="DOC STS" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskLDOC_STS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="77" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="IS_READ" PathID="TaskIS_READ" fieldSource="is_read">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="104" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="DOC_NO" PathID="TaskDOC_NO" fieldSource="doc_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="106" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="P_APP_USER_ID_DONOR" PathID="TaskP_APP_USER_ID_DONOR" fieldSource="p_app_user_id_donor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="107" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="P_APP_USER_ID_TAKEOVER" PathID="TaskP_APP_USER_ID_TAKEOVER" fieldSource="p_app_user_id_takeover">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="71" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="T_USER_CTL_ID" PathID="TaskT_USER_CTL_ID" fieldSource="t_user_ctl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="72" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="T_CTL_ID" PathID="TaskT_CTL_ID" fieldSource="t_ctl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="108" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_TYPE_ID" PathID="TaskPREV_DOC_TYPE_ID" fieldSource="prev_doc_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="109" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="PREV_PROC_ID" PathID="TaskPREV_PROC_ID" fieldSource="prev_proc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="110" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_ID" PathID="TaskPREV_DOC_ID" fieldSource="prev_doc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="111" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="PREV_CTL_ID" PathID="TaskPREV_CTL_ID" fieldSource="prev_ctl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="112" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SLOT_1" PathID="TaskSLOT_1" fieldSource="slot_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="113" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SLOT_2" PathID="TaskSLOT_2" fieldSource="slot_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SLOT_3" PathID="TaskSLOT_3" fieldSource="slot_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="115" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SLOT_4" PathID="TaskSLOT_4" fieldSource="slot_4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="116" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SLOT_5" PathID="TaskSLOT_5" fieldSource="slot_5">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="119" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="DOC_STS" PathID="TaskDOC_STS" fieldSource="doc_sts">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="120" fieldSourceType="DBColumn" dataType="Text" html="True" name="EVENT_COLORING" PathID="TaskEVENT_COLORING">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="122" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="123" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="PROC_STS" PathID="TaskPROC_STS" fieldSource="proc_sts">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="124" fieldSourceType="DBColumn" dataType="Text" html="False" name="CUST_INFO" fieldSource="cust_info" wizardCaption="DOC NO" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="TaskCUST_INFO">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="136" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="63" conditionType="Parameter" useIsNull="False" field="DOC_NO" parameterSource="s_DOC_NO" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="497" parameterType="Expression" variable="puser" dataType="Text" parameterSource="CCGetUserLogin()" defaultValue="&quot;ADMIN&quot;"/>
				<SQLParameter id="67" variable="s_keyword" parameterType="URL" defaultValue="&quot;&quot;" dataType="Text" parameterSource="s_keyword"/>
				<SQLParameter id="79" variable="sdonor_date" parameterType="URL" defaultValue="&quot;&quot;" dataType="Text" parameterSource="sdonor_date"/>
				<SQLParameter id="88" variable="pdoctype_id" parameterType="URL" dataType="Text" parameterSource="P_W_DOC_TYPE_ID"/>
				<SQLParameter id="89" variable="pproc_id" parameterType="URL" dataType="Text" parameterSource="P_W_PROC_ID"/>
				<SQLParameter id="90" variable="pprof_type" parameterType="URL" defaultValue="&quot;INBOX&quot;" dataType="Text" parameterSource="PROFILE_TYPE"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
<Record id="125" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="BROAD" actionPage="workflow_summary" errorSummator="Error" wizardFormMethod="post" PathID="BROAD" dataSource="select postcast from pack_task_profile.broadcaster ('{puser}') as tbl (ty_broadcast_ctl) 
where ty_broadcast_ctl = -99999" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" connection="ConnSIKP">
			<Components>
				<TextArea id="126" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="CASTER" PathID="BROADCASTER" fieldSource="POSTCAST">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="127" variable="puser" parameterType="Session" defaultValue="&quot;MO7002&quot;" dataType="Text" parameterSource="UserLogin"/>
			</SQLParameters>
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
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="workflow_summary_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="workflow_summary.php" forShow="True" url="workflow_summary.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
	</Events>
</Page>
