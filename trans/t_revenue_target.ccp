<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" dataSource="v_t_revenue_target" name="v_t_revenue_targetGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" orderBy="t_revenue_target_id">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="t_revenue_target.ccp" removeParameters="t_revenue_target_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_revenue_target.ccp" wizardThemeItem="GridA" PathID="v_t_revenue_targetGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="133" sourceType="DataField" name="t_revenue_target_id" source="t_revenue_target_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="year_code" fieldSource="year_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_t_revenue_targetGridyear_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_t_revenue_targetGriddescription">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_revenue_target_id" fieldSource="t_revenue_target_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="v_t_revenue_targetGridt_revenue_target_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="93" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_t_revenue_targetGridvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="107" fieldSourceType="DBColumn" dataType="Text" html="False" name="target_code" fieldSource="target_code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_t_revenue_targetGridtarget_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="108" fieldSourceType="DBColumn" dataType="Text" html="False" name="target_amount" fieldSource="target_amount" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_t_revenue_targetGridtarget_amount">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="95"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="97"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="131" conditionType="Parameter" useIsNull="False" field="upper(year_code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword" leftBrackets="1"/>
				<TableParameter id="132" conditionType="Parameter" useIsNull="False" field="upper(vat_code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword" rightBrackets="1"/>
				<TableParameter id="134" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_year_period_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="130" tableName="v_t_revenue_target" posLeft="10" posTop="10" posWidth="150" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="v_t_revenue_targetSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_revenue_target.ccp" PathID="v_t_revenue_targetSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="v_t_revenue_targetSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="v_t_revenue_targetSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="110" fieldSourceType="DBColumn" dataType="Text" name="p_year_periodGridPage" PathID="v_t_revenue_targetSearchp_year_periodGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="111" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetSearchp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="112" fieldSourceType="DBColumn" dataType="Text" name="year_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetSearchyear_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="138" fieldSourceType="DBColumn" dataType="Text" name="year_code" PathID="v_t_revenue_targetSearchyear_code">
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
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="v_t_revenue_targetForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="v_t_revenue_targetForm" customDeleteType="SQL" customDelete="DELETE FROM t_revenue_target
WHERE t_revenue_target_id = {t_revenue_target_id}" activeCollection="DSQLParameters" customUpdateType="SQL" customUpdate="UPDATE t_revenue_target SET 
target_code='{target_code}', 
description='{description}', 
updated_date=sysdate, 
updated_by='{updated_by}',
target_amt={target_amt},
p_vat_type_id={p_vat_type_id}
WHERE t_revenue_target_id={t_revenue_target_id}" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO t_revenue_target(t_revenue_target_id, p_year_period_id, target_code, description, creation_date, created_by, updated_date, updated_by, p_vat_type_id, target_amt) 
VALUES(generate_id('sikp','t_revenue_target','t_revenue_target_id'), {p_year_period_id}, '{target_code}', '{description}', sysdate, '{created_by}', sysdate, '{updated_by}', {p_vat_type_id}, {target_amt})" customInsertType="SQL" dataSource="v_t_revenue_target">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="v_t_revenue_targetFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="v_t_revenue_targetFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="v_t_revenue_targetFormButton_Delete" removeParameters="FLAG;t_revenue_target_id;s_keyword;t_revenue_targetGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="27" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="v_t_revenue_targetFormButton_Cancel" removeParameters="FLAG;t_revenue_target_id;s_keyword;t_revenue_targetGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" fieldSource="p_year_period_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetFormp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="target_code" fieldSource="target_code" required="True" caption="Kode" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetFormtarget_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="32" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" fieldSource="vat_code" required="True" caption="Jenis Pajak" wizardCaption="Listing No" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetFormvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="True" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="True" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="94" fieldSourceType="DBColumn" dataType="Float" name="p_vat_type_id" PathID="v_t_revenue_targetFormp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="105" fieldSourceType="DBColumn" dataType="Text" name="t_revenue_targetGridPage" PathID="v_t_revenue_targetFormt_revenue_targetGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="109" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_revenue_target_id" fieldSource="t_revenue_target_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="v_t_revenue_targetFormt_revenue_target_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="135" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="target_amt" fieldSource="target_amt" caption="Jumlah" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="v_t_revenue_targetFormtarget_amt" required="False" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="137" conditionType="Parameter" useIsNull="False" field="t_revenue_target_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_revenue_target_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="136" tableName="v_t_revenue_target" posLeft="10" posTop="10" posWidth="150" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="150" variable="p_year_period_id" dataType="Float" parameterType="Control" parameterSource="p_year_period_id" defaultValue="0"/>
				<SQLParameter id="151" variable="target_code" dataType="Text" parameterType="Control" parameterSource="target_code"/>
				<SQLParameter id="153" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="155" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="157" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="158" variable="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id" defaultValue="0"/>
				<SQLParameter id="160" variable="target_amt" dataType="Float" parameterType="Control" parameterSource="target_amt" defaultValue="0"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="139" field="p_year_period_id" dataType="Float" parameterType="Control" parameterSource="p_year_period_id"/>
				<CustomParameter id="140" field="target_code" dataType="Text" parameterType="Control" parameterSource="target_code"/>
				<CustomParameter id="141" field="vat_code" dataType="Text" parameterType="Control" parameterSource="vat_code"/>
				<CustomParameter id="142" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="143" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="144" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="145" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="146" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="147" field="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="148" field="t_revenue_target_id" dataType="Float" parameterType="Control" parameterSource="t_revenue_target_id"/>
				<CustomParameter id="149" field="target_amt" dataType="Float" parameterType="Control" parameterSource="target_amt"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="173" variable="target_code" dataType="Text" parameterType="Control" parameterSource="target_code"/>
				<SQLParameter id="175" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="179" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="180" variable="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id" defaultValue="0"/>
				<SQLParameter id="181" variable="t_revenue_target_id" dataType="Float" parameterType="Control" parameterSource="t_revenue_target_id" defaultValue="0"/>
				<SQLParameter id="182" variable="target_amt" dataType="Float" parameterType="Control" parameterSource="target_amt" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="161" field="p_year_period_id" dataType="Float" parameterType="Control" parameterSource="p_year_period_id"/>
				<CustomParameter id="162" field="target_code" dataType="Text" parameterType="Control" parameterSource="target_code"/>
				<CustomParameter id="163" field="vat_code" dataType="Text" parameterType="Control" parameterSource="vat_code"/>
				<CustomParameter id="164" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="165" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="166" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="167" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="168" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="169" field="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="170" field="t_revenue_target_id" dataType="Float" parameterType="Control" parameterSource="t_revenue_target_id"/>
				<CustomParameter id="171" field="target_amt" dataType="Float" parameterType="Control" parameterSource="target_amt"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="183" variable="t_revenue_target_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_revenue_target_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Label id="96" fieldSourceType="DBColumn" dataType="Text" html="False" name="year_code" PathID="year_code">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_revenue_target_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_revenue_target.php" forShow="True" url="t_revenue_target.php" comment="//" codePage="windows-1252"/>
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
