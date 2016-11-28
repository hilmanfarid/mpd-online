<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_rep_lap_spjpSearch" returnPage="t_cetak_surat_teguran_tahun_berjalan.ccp" PathID="t_rep_lap_spjpSearch" pasteActions="pasteActions" pasteAsReplace="pasteAsReplace">
			<Components>
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
				<TextBox id="570" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" PathID="t_rep_lap_spjpSearchvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="571" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_lap_spjpSearchp_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="566" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="ttd" wizardEmptyCaption="Select Value" PathID="t_rep_lap_spjpSearchttd" connection="ConnSIKP" _valueOfList="2" _nameOfList="Basah" dataSource="1;Barcode;2;Basah" required="True">
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
				<ListBox id="572" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="teg_ke" wizardEmptyCaption="Select Value" PathID="t_rep_lap_spjpSearchteg_ke" connection="ConnSIKP" dataSource="1;1;2;2;3;3" required="True" _valueOfList="3" _nameOfList="3">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="573" eventType="Client"/>
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
				<ListBox id="574" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="p_settlement_type_id" wizardEmptyCaption="Select Value" PathID="t_rep_lap_spjpSearchp_settlement_type_id" connection="ConnSIKP" dataSource="4;SKPDKB JABATAN;2;SKPDKB PEMERIKSAAN" required="True" _valueOfList="2" _nameOfList="SKPDKB PEMERIKSAAN">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="575" eventType="Client"/>
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
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" PathID="t_rep_lap_spjpSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
<ListBox id="576" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="tgl_cetak" wizardEmptyCaption="Select Value" PathID="t_rep_lap_spjpSearchtgl_cetak" connection="ConnSIKP" dataSource="1;Ya;0;Tidak" required="True" _valueOfList="0" _nameOfList="Tidak">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="577" eventType="Client"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_cetak_surat_teguran_tahun_berjalan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_cetak_surat_teguran_tahun_berjalan.php" forShow="True" url="t_cetak_surat_teguran_tahun_berjalan.php" comment="//" codePage="windows-1252"/>
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
