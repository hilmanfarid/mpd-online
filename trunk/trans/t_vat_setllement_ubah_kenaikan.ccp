<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="LOV" returnPage="t_vat_setllement_ubah_kenaikan.ccp" PathID="LOV" connection="ConnSIKP" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" activeCollection="ISQLParameters" customInsertType="SQL" customInsert="SELECT f_update_penalty_new({t_vat_setllement_id},{flag_piutang},{nilai_denda}, '{deskripsi}', '{user_name}') AS msg" dataSource="t_vat_setllement">
			<Components>
				<TextArea id="6" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="is_desc" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVis_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVButton1" operation="Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="24" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="in_flag_numeric" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="LOVin_flag_numeric" fieldSource="flag_piutang" connection="ConnSIKP" _valueOfList="0" _nameOfList="Tidak" dataSource="1;Ya;0;Tidak" defaultValue="0">
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
				<Hidden id="26" fieldSourceType="DBColumn" dataType="Text" name="i_vat_setllement_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVi_vat_setllement_id" fieldSource="i_vat_setllement_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
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
				<Event name="AfterExecuteInsert" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="25"/>
</Actions>
</Event>
</Events>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="18" variable="t_vat_setllement_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="t_vat_setllement_id"/>
				<SQLParameter id="19" variable="nilai_denda" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="nilai_denda"/>
				<SQLParameter id="20" variable="deskripsi" parameterType="Control" dataType="Text" parameterSource="deskripsi"/>
				<SQLParameter id="21" variable="user_name" parameterType="Session" dataType="Text" parameterSource="UserLogin"/>
				<SQLParameter id="23" variable="flag_piutang" parameterType="Control" dataType="Text" parameterSource="flag_piutang"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="17" field="t_vat_setllement_id" dataType="Text" parameterType="Control" parameterSource="t_vat_setllement_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="12" variable="t_vat_setllement_id" parameterType="Control" dataType="Text" parameterSource="t_vat_setllement_id" defaultValue="0"/>
				<SQLParameter id="13" variable="nilai_denda" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="nilai_denda"/>
				<SQLParameter id="14" variable="deskripsi" parameterType="Control" dataType="Text" parameterSource="deskripsi"/>
				<SQLParameter id="15" variable="user_name" parameterType="Session" dataType="Text" parameterSource="UserLogin"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_ubah_kenaikan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_ubah_kenaikan.php" forShow="True" url="t_vat_setllement_ubah_kenaikan.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
