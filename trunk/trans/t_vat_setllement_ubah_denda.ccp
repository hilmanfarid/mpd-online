<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="LOV" returnPage="t_vat_setllement_ubah_denda.ccp" PathID="LOV" connection="ConnSIKP" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" activeCollection="ISQLParameters" customInsertType="SQL" customInsert="SELECT f_update_penalty_new({t_vat_setllement_id},{flag_piutang},{nilai_denda}, '{deskripsi}', '{user_name}') AS msg" dataSource="t_vat_setllement">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nilai_denda" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVnilai_denda" fieldSource="nilai_denda">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="6" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="deskripsi" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVdeskripsi">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="7" fieldSourceType="DBColumn" dataType="Text" name="t_vat_setllement_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVt_vat_setllement_id" fieldSource="t_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVButton1" operation="Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="24" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="flag_piutang" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="LOVflag_piutang" fieldSource="flag_piutang" connection="ConnSIKP" _valueOfList="1" _nameOfList="Jadikan Ketetapan Denda" dataSource="0;Ubah Nilai;1;Jadikan Ketetapan Denda" defaultValue="0">
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
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_ubah_denda.php" forShow="True" url="t_vat_setllement_ubah_denda.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_ubah_denda_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
