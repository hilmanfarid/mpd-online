<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_rep_lap_spjpSearch" returnPage="t_cetak_ulang_rekap_surat_teguran.ccp" PathID="t_rep_lap_spjpSearch" pasteActions="pasteActions" pasteAsReplace="pasteAsReplace">
			<Components>
				<TextBox id="561" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" PathID="t_rep_lap_spjpSearchcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="562" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_lap_spjpSearchp_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="563" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_lap_spjpSearchp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="560" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_code" PathID="t_rep_lap_spjpSearchyear_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" PathID="t_rep_lap_spjpSearchButton_DoSearch">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="566" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="ListBox1" wizardEmptyCaption="Select Value" PathID="t_rep_lap_spjpSearchListBox1" connection="ConnSIKP" _valueOfList="2" _nameOfList="Denda" dataSource="1;1;2;2;3;3" fieldSource="i_flag_setoran" required="True">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="567" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Hidden id="570" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_lap_spjpSearchp_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="571" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" PathID="t_rep_lap_spjpSearchvat_code">
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
		<CodeFile id="Events" language="PHPTemplates" name="t_cetak_ulang_rekap_surat_teguran_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_cetak_ulang_rekap_surat_teguran.php" forShow="True" url="t_cetak_ulang_rekap_surat_teguran.php" comment="//" codePage="windows-1252"/>
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
