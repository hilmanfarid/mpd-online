<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="3" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="pengumumanGrid" pageSizeLimit="100" wizardCaption="List of V P Module Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" activeCollection="SQLParameters" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="select t_w_broadcast_ctl_id, to_char(valid_from, 'DD-MON-YYYY') as valid_from, 
to_char(valid_to, 'DD-MON-YYYY') as valid_to, user_name_entry, p_organ_input_id, is_private, decode(is_private,'Y','YA','TIDAK')is_private_code, p_organ_regional_id 
from t_w_broadcast_ctl
where upper(user_name_entry) like '%{s_keyword}%' 
order by t_w_broadcast_ctl_id desc">
			<Components>
				<Link id="12" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_w_broadcast_ctl.ccp" wizardThemeItem="GridA" PathID="pengumumanGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="163" sourceType="DataField" name="t_w_broadcast_ctl_id" source="t_w_broadcast_ctl_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="14" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_w_broadcast_ctl_id" fieldSource="t_w_broadcast_ctl_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="pengumumanGridt_w_broadcast_ctl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="user_name_entry" fieldSource="user_name_entry" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="pengumumanGriduser_name_entry">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="is_private_code" fieldSource="is_private_code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="pengumumanGridis_private_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="pengumumanGridvalid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="pengumumanGridvalid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="23" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="Rwnet">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="t_w_broadcast_ctl.ccp" removeParameters="t_w_broadcast_ctl_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="pengumumanGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="101" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="11" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="95"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
				<Field id="154" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="161" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="24" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="pengumumanForm" errorSummator="Error" wizardCaption="Add/Edit V P Module Role " wizardFormMethod="post" PathID="pengumumanForm" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM t_w_broadcast_ctl
WHERE t_w_broadcast_ctl_id = {t_w_broadcast_ctl_id}" customDeleteType="SQL" activeCollection="DSQLParameters" parameterTypeListName="ParameterTypeList" customUpdate="UPDATE t_w_broadcast_ctl SET 
user_name_entry='{user_name_entry}', 
valid_from=to_date('{valid_from}','DD-MON-YYYY'), 
valid_to=to_date('{valid_to}','DD-MON-YYYY'), 
is_private='{is_private}', 
postcast='{postcast}', 
p_organ_input_id={p_organ_input_id}, 
p_organ_regional_id = {p_organ_regional_id}
WHERE t_w_broadcast_ctl_id = {t_w_broadcast_ctl_id}" customUpdateType="SQL" customInsert="INSERT INTO t_w_broadcast_ctl(t_w_broadcast_ctl_id, 
user_name_entry, 
valid_from,
valid_to, 
is_private, 
postcast, 
p_organ_input_id,
p_organ_regional_id) 
VALUES(generate_id('sikp','t_w_broadcast_ctl','t_w_broadcast_ctl_id'), 
'{user_name_entry}', 
to_date('{valid_from}','DD-MON-YYYY'), 
to_date('{valid_to}','DD-MON-YYYY'),
'{is_private}', 
'{postcast}', 
{p_organ_input_id}, 
{p_organ_regional_id})" customInsertType="SQL" dataSource="select t_w_broadcast_ctl_id, to_char(valid_from, 'DD-MON-YYYY') as valid_from, 
to_char(valid_to, 'DD-MON-YYYY') as valid_to, user_name_entry, p_organ_input_id, is_private, decode(is_private,'Y','YA','TIDAK')is_private_code, 
p_organ_regional_id, postcast
from t_w_broadcast_ctl
where t_w_broadcast_ctl_id = {t_w_broadcast_ctl_id}">
			<Components>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="pengumumanFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="pengumumanFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="27" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="pengumumanFormButton_Delete" removeParameters="FLAG;t_w_broadcast_ctl_id;s_keyword;pengumumanGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="28" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="29" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="pengumumanFormButton_Cancel" removeParameters="FLAG;t_w_broadcast_ctl_id;s_keyword;pengumumanGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="31" fieldSourceType="DBColumn" dataType="Float" name="p_organ_input_id" fieldSource="p_organ_input_id" required="False" caption="p_organ_input_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="pengumumanFormp_organ_input_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="34" fieldSourceType="DBColumn" dataType="Float" name="p_organ_regional_id" fieldSource="p_organ_regional_id" required="False" caption="p_organ_regional_id" wizardCaption="P Module Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="pengumumanFormp_organ_regional_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="pengumumanFormvalid_from" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="Styles/sikp/Style.css" PathID="pengumumanFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="True" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="pengumumanFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="38" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="Styles/sikp/Style.css" PathID="pengumumanFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="42" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="user_name_entry" fieldSource="user_name_entry" required="True" caption="Nama User" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="pengumumanFormuser_name_entry" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="116" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="is_private" fieldSource="is_private" required="True" caption="Publikasikan?" wizardCaption="IS PRIVATE" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="pengumumanFormis_private" sourceType="ListOfValues" dataSource="Y;YA;N;TIDAK" connection="ConnSIKP">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextArea id="118" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="postcast" fieldSource="postcast" required="True" caption="Postcast" wizardCaption="POSTCAST" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="pengumumanFormpostcast">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="164" fieldSourceType="DBColumn" dataType="Float" name="t_w_broadcast_ctl_id" fieldSource="t_w_broadcast_ctl_id" required="False" caption="t_w_broadcast_ctl_id" wizardCaption="P Module Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="pengumumanFormt_w_broadcast_ctl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="162" variable="t_w_broadcast_ctl_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_w_broadcast_ctl_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
				<Field id="155" fieldName="*"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="144" variable="user_name_entry" dataType="Text" parameterType="Control" parameterSource="user_name_entry"/>
				<SQLParameter id="145" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<SQLParameter id="146" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to"/>
				<SQLParameter id="147" variable="is_private" dataType="Text" parameterType="Control" parameterSource="is_private"/>
				<SQLParameter id="148" variable="postcast" dataType="Text" parameterType="Control" parameterSource="postcast"/>
				<SQLParameter id="152" variable="p_organ_input_id" dataType="Float" parameterType="Expression" parameterSource="CCGetUserId()" defaultValue="-99"/>
				<SQLParameter id="165" variable="p_organ_regional_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_organ_regional_id"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="131" field="p_app_user_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_role_id"/>
				<CustomParameter id="132" field="code" dataType="Text" parameterType="Control" parameterSource="role_code"/>
				<CustomParameter id="133" field="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id"/>
				<CustomParameter id="134" field="to_char(p_app_user_role.valid_from,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="135" field="p_app_user_role.description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="136" field="p_app_user_role.created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="137" field="p_app_user_role.updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="138" field="to_char(p_app_user_role.creation_date,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="139" field="to_char(p_app_user_role.updated_date,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="140" field="to_char(p_app_user_role.valid_to,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<CustomParameter id="141" field="p_app_user_role.p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="67" variable="user_name_entry" dataType="Text" parameterType="Control" parameterSource="user_name_entry"/>
				<SQLParameter id="68" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from"/>
				<SQLParameter id="69" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to"/>
				<SQLParameter id="70" variable="is_private" dataType="Text" parameterType="Control" parameterSource="is_private"/>
				<SQLParameter id="73" variable="postcast" parameterType="Control" dataType="Text" parameterSource="postcast"/>
				<SQLParameter id="166" variable="p_organ_input_id" parameterType="Expression" defaultValue="-99" dataType="Text" parameterSource="CCGetUserId()"/>
				<SQLParameter id="167" variable="p_organ_regional_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_organ_regional_id"/>
				<SQLParameter id="168" variable="t_w_broadcast_ctl_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_w_broadcast_ctl_id"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="169" variable="t_w_broadcast_ctl_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_w_broadcast_ctl_id"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="52" conditionType="Parameter" useIsNull="False" field="p_app_user_role_id" dataType="Float" parameterType="Control" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="p_app_user_role_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="100" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="pengumumanSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_w_broadcast_ctl.ccp" PathID="pengumumanSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="pengumumanSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="pengumumanSearchs_keyword">
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_w_broadcast_ctl_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_w_broadcast_ctl.php" forShow="True" url="t_w_broadcast_ctl.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="51"/>
			</Actions>
		</Event>
	</Events>
</Page>
