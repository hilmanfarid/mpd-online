<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Label id="2" fieldSourceType="DBColumn" dataType="Text" html="False" name="app_user_name" PathID="app_user_name">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Record id="4" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_pass_byadminSearch" wizardCaption="Search V P Module Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_pass_byadmin.ccp" PathID="p_pass_byadminSearch" pasteActions="pasteActions">
			<Components>
				<Hidden id="48" fieldSourceType="DBColumn" dataType="Float" name="p_app_user_id" PathID="p_pass_byadminSearchp_app_user_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="49" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" PathID="p_pass_byadminSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Text" name="p_app_userGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_pass_byadminSearchp_app_userGridPage">
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
		<Record id="24" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_pass_byadminForm" dataSource="p_app_user" errorSummator="Error" wizardCaption="Add/Edit V P Module Role " wizardFormMethod="post" PathID="p_pass_byadminForm" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="USQLParameters" activeTableType="p_app_user" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customUpdate="UPDATE p_app_user SET 
user_pwd=md5('{n_user_pwd1}') 
WHERE  p_app_user_id = {p_app_user_id}" returnPage="p_app_user.ccp">
			<Components>
				<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_pass_byadminFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="n_user_pwd1" required="False" caption="n_user_pwd1" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_pass_byadminFormn_user_pwd1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="34" fieldSourceType="DBColumn" dataType="Float" name="p_app_user_id" fieldSource="p_app_user_id" required="False" caption="p_app_user_id" wizardCaption="P Module Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_pass_byadminFormp_app_user_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="94" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="n_user_pwd2" required="False" caption="n_user_pwd2" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_pass_byadminFormn_user_pwd2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="p_app_user_id" dataType="Float" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="p_app_user_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="93" tableName="p_app_user" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="85" variable="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
				<SQLParameter id="86" variable="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id" defaultValue="0"/>
				<SQLParameter id="87" variable="valid_from" dataType="Date" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yy HH:nn:ss" defaultValue="&quot;&quot;" DBFormat="dd-mm-yyyy"/>
				<SQLParameter id="88" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="89" variable="UserName" dataType="Text" parameterType="Session" parameterSource="UserName"/>
				<SQLParameter id="92" variable="valid_to" dataType="Date" parameterType="Control" parameterSource="valid_to" defaultValue="&quot;&quot;" DBFormat="dd-mm-yyyy" format="dd-mmm-yy HH:nn:ss"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="75" field="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id" omitIfEmpty="True"/>
				<CustomParameter id="77" field="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id" omitIfEmpty="True"/>
				<CustomParameter id="78" field="valid_from" dataType="Date" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="79" field="description" dataType="Text" parameterType="Control" parameterSource="description" omitIfEmpty="True"/>
				<CustomParameter id="80" field="created_by" dataType="Text" parameterType="Session" parameterSource="UserName" omitIfEmpty="True"/>
				<CustomParameter id="81" field="updated_by" dataType="Text" parameterType="Session" parameterSource="UserName" omitIfEmpty="True"/>
				<CustomParameter id="82" field="creation_date" dataType="Date" parameterType="Expression" parameterSource="sysdate" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="83" field="updated_date" dataType="Date" parameterType="Expression" parameterSource="sysdate" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="84" field="valid_to" dataType="Date" parameterType="Control" parameterSource="valid_to" omitIfEmpty="True"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="98" variable="n_user_pwd1" dataType="Text" parameterType="Control" parameterSource="n_user_pwd1"/>
				<SQLParameter id="99" variable="p_app_user_id" parameterType="Control" dataType="Float" parameterSource="p_app_user_id" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="96" conditionType="Parameter" useIsNull="False" field="p_app_user_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_app_user_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="97" field="user_pwd" dataType="Text" parameterType="Control" omitIfEmpty="True" parameterSource="n_user_pwd1"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="53" variable="p_app_user_role_id" parameterType="Control" dataType="Float" parameterSource="p_app_user_role_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="52" conditionType="Parameter" useIsNull="False" field="p_app_user_role_id" dataType="Float" parameterType="Control" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="p_app_user_role_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="p_pass_byadmin.php" forShow="True" url="p_pass_byadmin.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="p_pass_byadmin_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="100"/>
			</Actions>
		</Event>
	</Events>
</Page>
