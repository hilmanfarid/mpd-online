<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="3" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_cust_acc_status_editForm" returnPage="t_send_message_bphtb.ccp" PathID="t_cust_acc_status_editForm" connection="ConnSIKP" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" activeCollection="ISQLParameters" dataSource="select * from t_ppat where t_ppat_id = {t_ppat_id}" pasteAsReplace="pasteAsReplace" customInsertType="SQL" customInsert="SELECT f_send_message_to_ppat({sender_message_id},'{user_name}','{message_body}',null) as pesan">
			<Components>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_acc_status_editFormButton1" operation="Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextArea id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="message_body" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_acc_status_editFormmessage_body" fieldSource="message_body" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="7" fieldSourceType="DBColumn" dataType="Text" name="t_ppat_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_acc_status_editFormt_ppat_id" fieldSource="t_ppat_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="46" fieldSourceType="DBColumn" dataType="Text" name="t_message_inbox_bphtb_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_acc_status_editFormt_message_inbox_bphtb_id" fieldSource="t_message_inbox_bphtb_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="47" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" returnValueType="Number" name="message_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_cust_acc_status_editFormmessage_type" fieldSource="message_type" connection="ConnSIKP" dataSource="select p_message_type.p_message_type_id,p_message_type.message_type from p_message_type LEFT JOIN p_msg_type_role_map on p_message_type.p_message_type_id = p_msg_type_role_map.p_message_type_id
where p_app_role_id_for = 26">
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
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="8"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="22"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="27"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="51"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="26" conditionType="Parameter" useIsNull="False" field="t_vat_setllement_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="t_vat_setllement_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="40" variable="t_ppat_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="t_ppat_id"/>
			</SQLParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="48" variable="sender_message_id" parameterType="URL" dataType="Float" parameterSource="t_message_inbox_bphtb_id" defaultValue="0"/>
				<SQLParameter id="49" variable="user_name" parameterType="Session" dataType="Text" parameterSource="UserLogin"/>
				<SQLParameter id="50" variable="message_body" parameterType="Control" dataType="Text" parameterSource="message_body"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="17" field="t_vat_setllement_id" dataType="Text" parameterType="Control" parameterSource="t_vat_setllement_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="41" variable="t_cust_account_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="t_cust_account_id"/>
				<SQLParameter id="42" variable="p_account_status_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="p_account_status_id"/>
				<SQLParameter id="43" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="44" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
				<SQLParameter id="45" variable="user_name" parameterType="Session" dataType="Text" parameterSource="UserLogin"/>
			</USQLParameters>
			<UConditions/>
			<UFormElements>
				<CustomParameter id="11" field="t_vat_setllement_id" dataType="Text" parameterType="Control" parameterSource="t_vat_setllement_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_send_message_bphtb_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_send_message_bphtb.php" forShow="True" url="t_send_message_bphtb.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
