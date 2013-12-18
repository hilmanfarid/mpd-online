<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_villageGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" dataSource="SELECT a.p_village_id, a.p_sub_district_id, a.code, a.village_name, a.listing_no, 
to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.description, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by
FROM p_village a, p_sub_district b
WHERE a.p_sub_district_id = b.p_sub_district_id AND
a.p_sub_district_id = {p_sub_district_id} AND
(upper(a.code) like '%{s_keyword}%' OR
upper(a.village_name) like '%{s_keyword}%')
ORDER BY a.listing_no

" parameterTypeListName="ParameterTypeList">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_village.ccp" removeParameters="p_village_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_villageGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_village.ccp" wizardThemeItem="GridA" PathID="p_villageGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="170" sourceType="DataField" name="p_village_id" source="p_village_id"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_villageGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_villageGriddescription">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_village_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_villageGridp_village_id" fieldSource="p_village_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="93" fieldSourceType="DBColumn" dataType="Text" html="False" name="village_name" fieldSource="village_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_villageGridvillage_name">
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
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="150" variable="p_sub_district_id" dataType="Float" parameterType="URL" parameterSource="p_sub_district_id" defaultValue="0"/>
				<SQLParameter id="151" variable="s_keyword" dataType="Text" parameterType="URL" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_villageSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_village.ccp" PathID="p_villageSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_villageSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_villageSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="154" fieldSourceType="DBColumn" dataType="Float" name="p_district_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageSearchp_district_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="155" fieldSourceType="DBColumn" dataType="Text" name="p_districtGridPage" PathID="p_villageSearchp_districtGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="156" fieldSourceType="DBColumn" dataType="Text" name="district_code" PathID="p_villageSearchdistrict_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="159" fieldSourceType="DBColumn" dataType="Text" name="district_s_keyword" PathID="p_villageSearchdistrict_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="161" fieldSourceType="DBColumn" dataType="Float" name="p_state_id" fieldSource="p_state_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageSearchp_state_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="162" fieldSourceType="DBColumn" dataType="Text" name="p_stateGridPage" PathID="p_villageSearchp_stateGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="163" fieldSourceType="DBColumn" dataType="Text" name="state_code" PathID="p_villageSearchstate_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="164" fieldSourceType="DBColumn" dataType="Text" name="state_s_keyword" PathID="p_villageSearchstate_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="166" fieldSourceType="DBColumn" dataType="Float" name="p_sub_district_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageSearchp_sub_district_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="167" fieldSourceType="DBColumn" dataType="Text" name="p_sub_districtGridPage" PathID="p_villageSearchp_sub_districtGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="168" fieldSourceType="DBColumn" dataType="Text" name="sub_code" PathID="p_villageSearchsub_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="169" fieldSourceType="DBColumn" dataType="Text" name="sub_s_keyword" PathID="p_villageSearchsub_s_keyword">
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
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_villageForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_villageForm" customDeleteType="SQL" customDelete="DELETE FROM p_village WHERE p_village_id = {p_village_id}" activeCollection="DSQLParameters" customUpdateType="SQL" customUpdate="UPDATE p_village SET 
code='{code}', 
village_name = '{village_name}',
listing_no={listing_no},
description='{description}', 
updated_date=sysdate, 
updated_by='{updated_by}' 
WHERE p_village_id = {p_village_id}" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_village(p_village_id, code, village_name, listing_no, description, creation_date, created_by, updated_date, updated_by, p_sub_district_id) 
VALUES(generate_id('sikp','p_village','p_village_id'), '{code}', '{village_name}', {listing_no}, '{description}', sysdate, '{created_by}', sysdate, '{updated_by}', {p_sub_district_id})" customInsertType="SQL" dataSource="SELECT a.p_village_id, a.p_sub_district_id, a.code, a.village_name, a.listing_no, 
to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.description, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by
FROM p_village a, p_sub_district b
WHERE a.p_sub_district_id = b.p_sub_district_id AND
a.p_sub_district_id = {p_sub_district_id} AND
a.p_village_id = {p_village_id}" activeTableType="customDelete">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_villageFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_villageFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_villageFormButton_Delete" removeParameters="FLAG;p_village_id;s_keyword;p_villageGridPage">
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
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_villageFormButton_Cancel" removeParameters="FLAG;p_village_id;s_keyword;p_villageGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="p_village_id" fieldSource="p_village_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageFormp_village_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Kode" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="True" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="True" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="105" fieldSourceType="DBColumn" dataType="Text" name="p_villageGridPage" PathID="p_villageFormp_villageGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="126" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="village_name" fieldSource="village_name" required="True" caption="Kelurahan/Desa" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageFormvillage_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="listing_no" fieldSource="listing_no" required="True" caption="No Urut" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageFormlisting_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="153" fieldSourceType="DBColumn" dataType="Float" name="p_sub_district_id" fieldSource="p_sub_district_id" required="False" caption="p_sub_district_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_villageFormp_sub_district_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="112" conditionType="Parameter" useIsNull="False" field="p_state_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_state_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="122" parameterType="URL" variable="p_village_id" dataType="Float" parameterSource="p_village_id" defaultValue="0"/>
				<SQLParameter id="152" variable="p_sub_district_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_sub_district_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="82" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="83" variable="village_name" dataType="Text" parameterType="Control" parameterSource="village_name"/>
				<SQLParameter id="85" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="87" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="89" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="101" variable="listing_no" parameterType="Control" dataType="Float" parameterSource="listing_no" defaultValue="0"/>
				<SQLParameter id="157" variable="p_sub_district_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_sub_district_id"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="71" field="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
				<CustomParameter id="72" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="73" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="74" field="valid_from" dataType="Date" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="75" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="76" field="creation_date" dataType="Date" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="77" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="78" field="updated_date" dataType="Date" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="79" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="80" field="valid_to" dataType="Date" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="58" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="59" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no" defaultValue="0"/>
				<SQLParameter id="62" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="64" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="65" variable="p_village_id" parameterType="Control" dataType="Float" parameterSource="p_village_id" defaultValue="0"/>
				<SQLParameter id="103" variable="village_name" parameterType="Control" dataType="Text" parameterSource="village_name"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="128" field="p_state_id" dataType="Float" parameterType="Control" parameterSource="p_state_id"/>
				<CustomParameter id="129" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="130" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="131" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="132" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="133" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="134" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="135" field="state_name" dataType="Text" parameterType="Control" parameterSource="state_name"/>
				<CustomParameter id="136" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="160" variable="p_village_id" parameterType="Control" dataType="Float" parameterSource="p_village_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="158" conditionType="Parameter" useIsNull="False" field="p_district_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_district_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Label id="138" fieldSourceType="DBColumn" dataType="Text" html="False" name="sub_code" PathID="sub_code">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_village_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_village.php" forShow="True" url="p_village.php" comment="//" codePage="windows-1252"/>
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
