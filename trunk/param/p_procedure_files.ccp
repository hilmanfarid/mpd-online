<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Spring" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_procedure_filesGrid" pageSizeLimit="100" wizardCaption="List of P App Module Role " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="data tidak ditemukan" activeCollection="TableParameters" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" orderBy="p_procedure_files_id" dataSource="p_procedure_files">
			<Components>
				<Navigator id="41" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImages="Images" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="86" fieldSourceType="DBColumn" dataType="Text" html="False" name="filename" fieldSource="filename" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_procedure_filesGridfilename">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_procedure_files.ccp" wizardThemeItem="GridA" PathID="p_procedure_filesGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="243" sourceType="DataField" name="p_procedure_files_id" source="p_procedure_files_id"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_procedure_files.ccp" removeParameters="p_procedure_files_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_procedure_filesGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="123" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="193" fieldSourceType="DBColumn" dataType="Text" name="p_procedure_files_id" PathID="p_procedure_filesGridp_procedure_files_id" fieldSource="p_procedure_files_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="283" fieldSourceType="DBColumn" dataType="Float" html="False" name="sequence_no" fieldSource="sequence_no" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_procedure_filesGridsequence_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="87" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="88"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="183"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="242" conditionType="Parameter" useIsNull="False" field="p_procedure_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_procedure_id"/>
<TableParameter id="284" conditionType="Parameter" useIsNull="False" field="upper(filename)" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
</TableParameters>
			<JoinTables>
				<JoinTable id="241" tableName="p_procedure_files" posLeft="10" posTop="10" posWidth="157" posHeight="180"/>
</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_procedure_filesSearch" wizardCaption="Search P App Module Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_procedure_files.ccp" PathID="p_procedure_filesSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="p_procedure_filesSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_procedure_filesSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="100" fieldSourceType="DBColumn" dataType="Text" name="p_procedure_id" PathID="p_procedure_filesSearchp_procedure_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="135" fieldSourceType="DBColumn" dataType="Text" name="p_procedureGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedure_filesSearchp_procedureGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="188" fieldSourceType="DBColumn" dataType="Text" name="proc_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedure_filesSearchproc_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
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
		<Label id="96" fieldSourceType="DBColumn" dataType="Text" html="False" name="proc_code" PathID="proc_code">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_procedure_filesForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_procedure_filesForm" customDeleteType="SQL" customDelete="DELETE FROM p_procedure_files 
WHERE  p_procedure_files_id = {p_procedure_files_id}" activeCollection="USQLParameters" customUpdateType="SQL" customUpdate="UPDATE p_procedure_files SET 
filename='{filename}', 
updated_date=sysdate, 
sequence_no={sequence_no},
updated_by='{updated_by}' 
WHERE p_procedure_files_id={p_procedure_files_id}" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_procedure_files(p_procedure_files_id, filename, updated_date, updated_by, p_procedure_id, created_by, creation_date, sequence_no) 
VALUES(generate_id('sikp','p_procedure_files','p_procedure_files_id'), '{filename}', sysdate, '{updated_by}', '{p_procedure_id}', '{created_by}', sysdate, {sequence_no})" customInsertType="SQL" dataSource="SELECT p_procedure_id, p_procedure_files_id, filename, 
sequence_no, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by, to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by 
FROM p_procedure_files
WHERE p_procedure_files_id = {p_procedure_files_id} " activeTableType="p_procedure_files">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_procedure_filesFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_procedure_filesFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_procedure_filesFormButton_Delete" removeParameters="p_procedure_files_id;s_keyword;FLAG;p_procedure_filesGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="27" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="124" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_procedure_filesFormButton_Cancel" removeParameters="p_procedure_files_id;s_keyword;FLAG;p_procedure_filesGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="125" fieldSourceType="DBColumn" dataType="Float" name="p_procedure_files_id" fieldSource="p_procedure_files_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedure_filesFormp_procedure_files_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="filename" fieldSource="filename" required="True" caption="Folder Web dan Nama File Utama" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedure_filesFormfilename">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="126" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedure_filesFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedure_filesFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="180" fieldSourceType="DBColumn" dataType="Text" name="p_procedure_filesGridPage" PathID="p_procedure_filesFormp_procedure_filesGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="197" fieldSourceType="DBColumn" dataType="Text" name="p_procedure_id" PathID="p_procedure_filesFormp_procedure_id" fieldSource="p_procedure_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedure_filesFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedure_filesFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="280" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="sequence_no" fieldSource="sequence_no" required="True" caption="Sequence No" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedure_filesFormsequence_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="128" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="245" conditionType="Parameter" useIsNull="False" field="p_procedure_files_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_procedure_files_id"/>
</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="254" parameterType="URL" variable="p_procedure_files_id" dataType="Float" parameterSource="p_procedure_files_id"/>
</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="263" variable="filename" dataType="Text" parameterType="Control" parameterSource="filename"/>
<SQLParameter id="265" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="266" variable="p_procedure_id" dataType="Text" parameterType="Control" parameterSource="p_procedure_id"/>
<SQLParameter id="267" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="281" variable="sequence_no" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="sequence_no"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="255" field="p_procedure_role_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_files_id" omitIfEmpty="True"/>
<CustomParameter id="256" field="filename" dataType="Text" parameterType="Control" parameterSource="filename" omitIfEmpty="True"/>
<CustomParameter id="257" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
<CustomParameter id="258" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
<CustomParameter id="259" field="p_procedure_id" dataType="Text" parameterType="Control" parameterSource="p_procedure_id" omitIfEmpty="True"/>
<CustomParameter id="260" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
<CustomParameter id="261" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="275" variable="p_procedure_files_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_files_id" defaultValue="0"/>
<SQLParameter id="276" variable="filename" dataType="Text" parameterType="Control" parameterSource="filename"/>
<SQLParameter id="278" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="282" variable="sequence_no" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="sequence_no"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="268" field="p_procedure_role_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_files_id"/>
<CustomParameter id="269" field="filename" dataType="Text" parameterType="Control" parameterSource="filename"/>
<CustomParameter id="270" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="271" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="272" field="p_procedure_id" dataType="Text" parameterType="Control" parameterSource="p_procedure_id"/>
<CustomParameter id="273" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="274" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="279" variable="p_procedure_files_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_procedure_files_id"/>
</DSQLParameters>
			<DConditions>
				<TableParameter id="226" conditionType="Parameter" useIsNull="False" field="p_procedure_role_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_procedure_role_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_procedure_files_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_procedure_files.php" forShow="True" url="p_procedure_files.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="89"/>
			</Actions>
		</Event>
	</Events>
</Page>
