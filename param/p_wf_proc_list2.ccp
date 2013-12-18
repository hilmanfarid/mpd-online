<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="67" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_workflowForm" connection="ConnSIKP" customInsertType="SQL" customInsert="INSERT INTO p_w_chart_proc(p_workflow_id, update_by, create_by, p_procedure_id_prev, valid_from, valid_to, p_w_chart_proc_id, importance_level, p_procedure_id_next, f_init, p_procedure_id_alt, create_date, update_date, sequence_no) 
VALUES({p_workflow_id}, '{update_by}', '{create_by}', decode({p_procedure_id_prev},0,null,{p_procedure_id_prev}), to_date('{valid_from}','DD-MON-YYYY'), case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end, generate_id('sikp','p_w_chart_proc','p_w_chart_proc_id'), '{importance_level}', decode({p_procedure_id_next},0,null,{p_procedure_id_next}), '{f_init}', decode({p_procedure_id_alt},0,null,{p_procedure_id_alt}), sysdate, sysdate, decode({sequence_no},0,null,{sequence_no}))" customUpdateType="SQL" customUpdate="UPDATE p_w_chart_proc SET 
p_workflow_id={p_workflow_id}, 
update_by='{update_by}', 
update_date=sysdate,
p_procedure_id_prev=decode({p_procedure_id_prev},0,null,{p_procedure_id_prev}), 
valid_from=to_date('{valid_from}','DD-MON-YYYY'), 
valid_to=case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end,  
importance_level='{importance_level}', 
p_procedure_id_next=decode({p_procedure_id_next},0,null,{p_procedure_id_next}), 
f_init='{f_init}',
sequence_no=decode({sequence_no},0,null,{sequence_no}), 
p_procedure_id_alt=decode({p_procedure_id_alt},0,null,{p_procedure_id_alt})
WHERE p_w_chart_proc_id={p_w_chart_proc_id}" customDeleteType="SQL" customDelete="DELETE FROM p_w_chart_proc 
WHERE  p_w_chart_proc_id = {p_w_chart_proc_id} " PathID="p_workflowForm" pasteActions="pasteActions" activeCollection="ISQLParameters" parameterTypeListName="ParameterTypeList" dataSource="v_wf_chart_edit">
			<Components>
				<Button id="68" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" removeParameters="FLAG" PathID="p_workflowFormButton_Insert" returnPage="p_wf_procedure.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="69" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" removeParameters="FLAG" PathID="p_workflowFormButton_Update" returnPage="p_wf_procedure.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="70" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" removeParameters="FLAG" PathID="p_workflowFormButton_Delete" returnPage="p_wf_procedure.ccp">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="71" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="72" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" removeParameters="FLAG" PathID="p_workflowFormButton_Cancel" returnPage="p_wf_procedure.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="73" fieldSourceType="DBColumn" dataType="Float" name="p_workflow_id" caption="p_workflow_id" fieldSource="p_workflow_id" PathID="p_workflowFormp_workflow_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="74" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="update_by" caption="Updated By" fieldSource="update_by" defaultValue="CCGetUserLogin()" required="False" PathID="p_workflowFormupdate_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="75" fieldSourceType="DBColumn" dataType="Text" name="p_workflowGridPage" PathID="p_workflowFormp_workflowGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="77" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="update_date" caption="Updated Date" fieldSource="update_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)" required="False" PathID="p_workflowFormupdate_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="create_by" caption="Created By" fieldSource="create_by" defaultValue="CCGetUserLogin()" required="True" PathID="p_workflowFormcreate_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="create_date" caption="Creation Date" fieldSource="create_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)" required="True" PathID="p_workflowFormcreate_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="78" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="pekerjaan_prev" caption="Pekerjaan Sebelum" fieldSource="pekerjaan_prev" required="True" PathID="p_workflowFormpekerjaan_prev">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="79" fieldSourceType="DBColumn" dataType="Float" name="p_procedure_id_prev" caption="p_procedure_id_prev" fieldSource="p_procedure_id_prev" PathID="p_workflowFormp_procedure_id_prev">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="cvalid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormvalid_from" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="34" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="p_workflowFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="cvalid_to" required="False" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="p_workflowFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="81" fieldSourceType="DBColumn" dataType="Float" name="p_w_chart_proc_id" caption="p_w_chart_proc_id" fieldSource="p_w_chart_proc_id" PathID="p_workflowFormp_w_chart_proc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="173" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="importance_level" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="p_workflowFormimportance_level" connection="ConnSIKP" dataSource="O;OPSIONAL;M;WAJIB" fieldSource="importance_level" _valueOfList="M" _nameOfList="WAJIB" required="True" caption="Init Sub">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="176" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="pekerjaan_next" caption="Pekerjaan Sesudah" fieldSource="pekerjaan_next" required="False" PathID="p_workflowFormpekerjaan_next">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="177" fieldSourceType="DBColumn" dataType="Float" name="p_procedure_id_next" caption="p_procedure_id_next" fieldSource="p_procedure_id_next" PathID="p_workflowFormp_procedure_id_next">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="178" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="f_init" caption="Fungsi Init Sub" fieldSource="f_init" required="False" PathID="p_workflowFormf_init">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="179" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="pekerjaan_alt" caption="Alternate (Dispatcher)" fieldSource="pekerjaan_alt" required="False" PathID="p_workflowFormpekerjaan_alt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="180" fieldSourceType="DBColumn" dataType="Float" name="p_procedure_id_alt" caption="p_procedure_id_alt" fieldSource="p_procedure_id_alt" PathID="p_workflowFormp_procedure_id_alt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="242" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="sequence_no" caption="No. Sequence" fieldSource="sequence_no" required="False" PathID="p_workflowFormsequence_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="82" conditionType="Parameter" useIsNull="False" field="p_workflow_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_workflow_id"/>
				<TableParameter id="83" conditionType="Parameter" useIsNull="False" field="p_w_chart_proc_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_w_chart_proc_id"/>
				<TableParameter id="182" conditionType="Parameter" useIsNull="False" field="p_procedure_id_prev" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_procedure_id_prev"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="181" tableName="v_wf_chart_edit" posLeft="10" posTop="10" posWidth="158" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters>
				<SPParameter id="Key176" parameterName="i_p_app_user_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Expression" parameterSource="0" scale="10" precision="6"/>
				<SPParameter id="Key178" parameterName="i_full_name" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="full_name" scale="10" precision="6"/>
				<SPParameter id="Key179" parameterName="i_email_address" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="email_address" scale="10" precision="6"/>
				<SPParameter id="Key181" parameterName="i_p_data_status_list_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_data_status_list_id" scale="10" precision="6"/>
				<SPParameter id="Key182" parameterName="i_p_region_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_region_id" scale="10" precision="6"/>
				<SPParameter id="Key184" parameterName="i_description" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="description" scale="10" precision="6"/>
				<SPParameter id="Key185" parameterName="i_ip_address" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="ip_address" scale="10" precision="6"/>
				<SPParameter id="Key187" parameterName="i_expired_pwd" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="expired_pwd" scale="10" precision="6"/>
				<SPParameter id="Key188" parameterName="i_user_by" dataType="Char" dataSize="255" direction="Input" parameterType="Session" parameterSource="UserName" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
				<SQLParameter id="199" variable="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
				<SQLParameter id="200" variable="update_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="202" variable="create_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="205" variable="p_procedure_id_prev" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_prev" defaultValue="0"/>
				<SQLParameter id="206" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<SQLParameter id="207" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<SQLParameter id="208" variable="p_w_chart_proc_id" dataType="Float" parameterType="Control" parameterSource="p_w_chart_proc_id"/>
				<SQLParameter id="209" variable="importance_level" dataType="Text" parameterType="Control" parameterSource="importance_level"/>
				<SQLParameter id="211" variable="p_procedure_id_next" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_next" defaultValue="0"/>
				<SQLParameter id="212" variable="f_init" dataType="Text" parameterType="Control" parameterSource="f_init"/>
				<SQLParameter id="214" variable="p_procedure_id_alt" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_alt" defaultValue="0"/>
				<SQLParameter id="244" variable="sequence_no" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="sequence_no"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="183" field="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
				<CustomParameter id="184" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="186" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="189" field="p_procedure_id_prev" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_prev"/>
				<CustomParameter id="190" field="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="191" field="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<CustomParameter id="192" field="p_w_chart_proc_id" dataType="Float" parameterType="Control" parameterSource="p_w_chart_proc_id"/>
				<CustomParameter id="193" field="importance_level" dataType="Text" parameterType="Control" parameterSource="importance_level"/>
				<CustomParameter id="195" field="p_procedure_id_next" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_next"/>
				<CustomParameter id="196" field="f_init" dataType="Text" parameterType="Control" parameterSource="f_init"/>
				<CustomParameter id="198" field="p_procedure_id_alt" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_alt"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key154" parameterName="i_flag" dataType="Numeric" dataSize="0" direction="Input" parameterType="Expression" parameterSource="2" scale="10" precision="6"/>
				<SPParameter id="Key155" parameterName="i_p_app_user_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_app_user_id" scale="10" precision="6"/>
				<SPParameter id="Key156" parameterName="i_user_name" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="user_name" scale="10" precision="6"/>
				<SPParameter id="Key157" parameterName="i_full_name" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="full_name" scale="10" precision="6"/>
				<SPParameter id="Key158" parameterName="i_email_address" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="email_address" scale="10" precision="6"/>
				<SPParameter id="Key159" parameterName="i_p_user_type_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_user_type_id" scale="10" precision="6"/>
				<SPParameter id="Key160" parameterName="i_p_data_status_list_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_data_status_list_id" scale="10" precision="6"/>
				<SPParameter id="Key161" parameterName="i_p_region_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_region_id" scale="10" precision="6"/>
				<SPParameter id="Key162" parameterName="i_p_region_structure_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_region_structure_id" scale="10" precision="6"/>
				<SPParameter id="Key163" parameterName="i_description" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="description" scale="10" precision="6"/>
				<SPParameter id="Key164" parameterName="i_ip_address" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="ip_address" scale="10" precision="6"/>
				<SPParameter id="Key165" parameterName="i_expired_user" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="expired_user" scale="10" precision="6"/>
				<SPParameter id="Key166" parameterName="i_expired_pwd" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="expired_pwd" scale="10" precision="6"/>
				<SPParameter id="Key167" parameterName="i_user_by" dataType="Char" dataSize="255" direction="Input" parameterType="Session" parameterSource="UserName" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
				<SQLParameter id="231" variable="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
				<SQLParameter id="232" variable="update_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="233" variable="p_procedure_id_prev" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_prev" defaultValue="0"/>
				<SQLParameter id="234" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<SQLParameter id="235" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<SQLParameter id="236" variable="p_w_chart_proc_id" dataType="Float" parameterType="Control" parameterSource="p_w_chart_proc_id"/>
				<SQLParameter id="237" variable="importance_level" dataType="Text" parameterType="Control" parameterSource="importance_level"/>
				<SQLParameter id="238" variable="p_procedure_id_next" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_next" defaultValue="0"/>
				<SQLParameter id="239" variable="f_init" dataType="Text" parameterType="Control" parameterSource="f_init"/>
				<SQLParameter id="240" variable="p_procedure_id_alt" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_alt" defaultValue="0"/>
				<SQLParameter id="243" variable="sequence_no" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="sequence_no"/>
</USQLParameters>
			<UConditions/>
			<UFormElements>
				<CustomParameter id="215" field="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
				<CustomParameter id="216" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="221" field="p_procedure_id_prev" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_prev"/>
				<CustomParameter id="222" field="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="223" field="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<CustomParameter id="224" field="p_w_chart_proc_id" dataType="Float" parameterType="Control" parameterSource="p_w_chart_proc_id"/>
				<CustomParameter id="225" field="importance_level" dataType="Text" parameterType="Control" parameterSource="importance_level"/>
				<CustomParameter id="227" field="p_procedure_id_next" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_next"/>
				<CustomParameter id="228" field="f_init" dataType="Text" parameterType="Control" parameterSource="f_init"/>
				<CustomParameter id="230" field="p_procedure_id_alt" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_alt"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="241" variable="p_w_chart_proc_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_w_chart_proc_id"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="169" conditionType="Parameter" useIsNull="False" field="p_wf_procedure_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_wf_procedure_id"/>
				<TableParameter id="170" conditionType="Parameter" useIsNull="False" field="prev_procedure_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="prev_procedure_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_wf_proc_list2_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_wf_proc_list2.php" forShow="True" url="p_wf_proc_list2.php" comment="//" codePage="windows-1252"/>
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
