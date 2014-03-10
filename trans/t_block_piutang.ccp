<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="3" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_cust_acc_status_editForm" returnPage="t_block_piutang.ccp" PathID="t_cust_acc_status_editForm" connection="ConnSIKP" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" activeCollection="UConditions" dataSource="select * from p_block_piutang where block_id=1" customUpdateType="Table" customUpdate="p_block_piutang" pasteAsReplace="pasteAsReplace" activeTableType="customUpdate">
			<Components>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_acc_status_editFormButton1" operation="Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="39" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="p_account_status_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_cust_acc_status_editFormp_account_status_id" connection="ConnSIKP" dataSource="T;BLOCK;F;BUKA BLOCK" _valueOfList="F" _nameOfList="BUKA BLOCK" fieldSource="block_status">
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
			</Events>
			<TableParameters>
				<TableParameter id="26" conditionType="Parameter" useIsNull="False" field="t_vat_setllement_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="t_vat_setllement_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="18" variable="t_vat_setllement_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="t_vat_setllement_id"/>
				<SQLParameter id="19" variable="total_trans_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="total_trans_amount"/>
				<SQLParameter id="20" variable="alasan" parameterType="Control" dataType="Text" parameterSource="alasan"/>
				<SQLParameter id="21" variable="user_name" parameterType="Session" dataType="Text" parameterSource="UserLogin"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="17" field="t_vat_setllement_id" dataType="Text" parameterType="Control" parameterSource="t_vat_setllement_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
			</USQLParameters>
			<UConditions>
<TableParameter id="42" conditionType="Parameter" useIsNull="False" field="block_id" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="1"/>
</UConditions>
			<UFormElements>
				<CustomParameter id="41" field="block_status" dataType="Text" parameterType="Control" parameterSource="p_account_status_id" omitIfEmpty="True"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_block_piutang_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_block_piutang.php" forShow="True" url="t_block_piutang.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
